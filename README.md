# Google Cloud

[Deploying a containerized web application](https://cloud.google.com/kubernetes-engine/docs/tutorials/hello-app)

## Create networks and run containers
```bash
docker-compose build --force-rm
docker network create gc-network
docker-compose up -d
```