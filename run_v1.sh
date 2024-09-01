#! /bin/bash

echo " Going to team-b-school"
cd team-b-school

echo "Pulling latest code"
#git fetch origin
#git reset --hard origin/main

echo "Building docker image"
docker build -t registry.gitlab.com/monverdict/team-b-school .

docker login -u Shadows97 -p THEPASWWORD registry.gitlab.com

echo "Pushing docker image"
docker push registry.gitlab.com/monverdict/team-b-school

echo "Going to root"
cd ..


kubectl create configmap laravel-config-map \
    --from-env-file=team-b-school/.env \
    --dry-run=client -o yaml | kubectl apply -f -

echo "Deploying docker image"
su gitlab-runner -c "./deploy.sh"

su gitlab-runner -c "kubectl rollout restart deployment.apps/laravel-app"
