import os
from typing import List, Optional
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import cohere

COHERE_API_KEY = os.getenv("COHERE_API_KEY", "")
co = cohere.Client(COHERE_API_KEY) if COHERE_API_KEY else None

app = FastAPI(title="AI Professor Discussion API")

PROFESSOR_CHARACTERS = {
    "ahmet": "You are Prof. Dr. Ahmet Yılmaz, an artificial intelligence expert. You explain topics using AI algorithms, machine learning, and ethical approaches.",
    "ayse": "You are Dr. Ayşe Kaya, a cybersecurity expert. You address topics with security protocols, cyber threats, and protection methods.",
    "zeynep": "You are Zeynep Demir, M.Sc., a data science expert. You evaluate topics with data analytics, statistical methods, and data-driven approaches.",
    "elif": "You are Prof. Dr. Elif Çelik, a software engineering expert. You explain topics with software development processes, design patterns, and coding practices.",
    "mehmet": "You are Prof. Dr. Elif Çelik, a software engineering expert. You explain topics with software development processes, design patterns, and coding practices.",
    "burak": "You are Dr. Burak Şahin, a computer networks expert. You address topics with network protocols, network security, and communication systems.",
    "mustafa": "You are Mustafa Koç, a computer graphics and visualization expert. You evaluate topics from the perspective of visual processing, 3D modeling, and data visualization."
}

class Comment(BaseModel):
    role: str
    content: str

class DiscussionRequest(BaseModel):
    professors: List[str]
    topic: str
    comments: Optional[List[Comment]] = []

class ProfessorResponse(BaseModel):
    professor_id: str
    professor_name: str
    response: str

def get_professor_response(professor_id: str, topic: str, comments: List[Comment] = []):
    professor_names = {
        "ahmet": "Prof. Dr. Ahmet Yılmaz",
        "ayse": "Dr. Ayşe Kaya",
        "zeynep": "Zeynep Demir, M.Sc.",
        "elif": "Prof. Dr. Elif Çelik",
        "mehmet": "Prof. Dr. Elif Çelik",
        "burak": "Dr. Burak Şahin",
        "mustafa": "Mustafa Koç"
    }
    professor_name = professor_names.get(professor_id, professor_id.title() + " Professor")

    if not co:
        return ProfessorResponse(
            professor_id=professor_id,
            professor_name=professor_name,
            response="Cohere API key is not configured. Please set the COHERE_API_KEY environment variable."
        )

    try:
        professor_character = PROFESSOR_CHARACTERS.get(professor_id, f"You are Professor {professor_id}.")
        message = f"Topic: {topic}\n\n"
        
        if comments:
            message += "Previous comments:\n"
            for comment in comments:
                message += f"- {comment.content}\n"
            message += "\n"
        
        message += f"Address this topic as {professor_name} from the perspective of your expertise and share your views. Start your response with '{professor_name}:'."
        
        response = co.chat(
            model="command-r-plus",
            message=message,
            preamble=professor_character,
            temperature=0.8,
            max_tokens=500
        )
        
        return ProfessorResponse(
            professor_id=professor_id,
            professor_name=professor_name,
            response=response.text
        )
    except Exception as e:
        return ProfessorResponse(
            professor_id=professor_id,
            professor_name=professor_name,
            response=f"Sorry, I cannot respond at the moment. Error: {str(e)}"
        )

@app.post("/discussion")
def create_discussion(request: DiscussionRequest):
    if not 1 <= len(request.professors) <= 3:
        raise HTTPException(status_code=400, detail="You must select between 1 and 3 professors.")
    
    invalid_professors = [p for p in request.professors if p not in PROFESSOR_CHARACTERS]
    if invalid_professors:
        raise HTTPException(status_code=400, detail=f"Invalid professor(s): {', '.join(invalid_professors)}")
    
    try:
        professor_responses = []
        for professor_id in request.professors:
            response = get_professor_response(professor_id, request.topic, request.comments)
            professor_responses.append(response.dict())
        
        if len(request.professors) == 1:
            return {
                "topic": request.topic,
                "professor": request.professors[0],
                "professor_name": professor_responses[0]["professor_name"],
                "response": professor_responses[0]["response"]
            }
        
        discussion_text = f"Topic: {request.topic}\n\n"
        discussion_text += "Professors' Views:\n\n"
        
        for i, response in enumerate(professor_responses, 1):
            discussion_text += f"{i}. {response['response']}\n\n"
        
        discussion_text += "These different perspectives help us better understand the topic."
        
        return {
            "topic": request.topic,
            "professors": request.professors,
            "discussion": discussion_text,
            "professor_responses": professor_responses,
            "discussion_count": len(professor_responses)
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"An error occurred during the discussion: {str(e)}")

@app.get("/")
def home():
    return {
        "message": "AI Professor Discussion API is running!",
        "available_professors": list(PROFESSOR_CHARACTERS.keys()),
        "usage": "Use the POST /discussion endpoint"
    }

@app.get("/professors")
def professor_list():
    professor_names = {
        "ahmet": "Prof. Dr. Ahmet Yılmaz (Artificial Intelligence)",
        "ayse": "Dr. Ayşe Kaya (Cybersecurity)",
        "zeynep": "Zeynep Demir, M.Sc. (Data Science)",
        "elif": "Prof. Dr. Elif Çelik (Software Engineering)",
        "burak": "Dr. Burak Şahin (Computer Networks)",
        "mustafa": "Mustafa Koç (Computer Graphics and Visualization)"
    }
    return {"professors": professor_names}
