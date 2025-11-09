FROM python:3.13-slim
WORKDIR /app
COPY ./requirements.txt ./requirements.txt
RUN apt-get update && apt-get install build-essential binutils-x86-64-linux-gnu -y
RUN pip install -r requirements.txt
EXPOSE 5000
CMD ["flask", "--app", "server.py", "run", "--host=0.0.0.0"]