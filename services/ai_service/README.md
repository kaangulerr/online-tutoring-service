# AI Professor Discussion Service (`ai_service`)

A FastAPI microservice that powers the AI Professor Chat functionality in the Open Course platform using Cohere's `command-r-plus` model.

## Features
- Simulated persona responses for 6 distinct academic professors (Artificial Intelligence, Cybersecurity, Data Science, Software Engineering, Computer Networks, and Computer Graphics).
- Support for single professor queries or multi-professor discussions (comparing perspectives).
- Fully asynchronous REST API built with FastAPI and Uvicorn.

## Getting Started

### Prerequisites
- Python 3.9+
- A Cohere API Key ([Cohere Dashboard](https://dashboard.cohere.com/))

### Local Installation

1. Navigate to the service directory:
   ```bash
   cd services/ai_service
   ```

2. Create and activate a virtual environment:
   ```bash
   python3 -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   ```

3. Install dependencies:
   ```bash
   pip install -r requirements.txt
   ```

4. Configure environment:
   ```bash
   cp .env.example .env
   ```
   Set your `COHERE_API_KEY` in `.env` or export it:
   ```bash
   export COHERE_API_KEY=your_cohere_api_key_here
   ```

5. Start the server:
   ```bash
   uvicorn main:app --reload --host 0.0.0.0 --port 8000
   ```
   The service will run at `http://localhost:8000`.

## Deployment (Railway / Render / Docker)

- **Root Directory:** Set root directory to `services/ai_service` if deploying from this monorepo.
- **Start Command:** Automatically recognized from `Procfile` (`uvicorn main:app --host=0.0.0.0 --port=${PORT:-8000}`).
- **Environment Variables:** Set `COHERE_API_KEY` in your hosting provider's environment variables dashboard.
- **Connect with Main App:** Copy the deployed service URL and set `AI_CHAT_API_URL=https://your-deployed-service.up.railway.app` in the root `.env` file of the PHP application.

## API Endpoints

- `GET /`: Health check and basic service information.
- `GET /professors`: List all available professors and their specializations.
- `POST /discussion`: Submit a discussion or question to selected professors.
  - **Payload example:**
    ```json
    {
      "professors": ["ahmet"],
      "topic": "Explain artificial neural networks",
      "comments": []
    }
    ```
