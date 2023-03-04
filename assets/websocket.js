fetch("/ws")
  .then((response) => response.json())
  .then((data) => console.log(data));