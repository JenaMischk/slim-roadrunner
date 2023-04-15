from locust import task, FastHttpUser

class HelloWorldUser(FastHttpUser):
    host = "http://localhost:8080"
    @task
    def hello_world(self):
        self.client.get("/")