#!/bin/bash

echo "iniciando container PHP"
docker compose -f docker-compose.yml down
docker compose -f docker-compose.yml build --no-cache && \
docker compose -f docker-compose.yml up -d
docker exec -it f79bf7805a1b bash
