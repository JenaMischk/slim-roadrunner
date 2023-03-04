from locust import task, FastHttpUser

class HelloWorldUser(FastHttpUser):
    @task
    def hello_world(self):
        self.client.get("/fds")