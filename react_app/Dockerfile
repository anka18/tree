FROM ubuntu:16.04

RUN apt-get update
RUN apt-get install -y npm build-essential libssl-dev

RUN apt-get install -y curl git
# установка nodejs version manager
RUN /bin/bash -c "curl -sL https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh -o install_nvm.sh; /bin/bash install_nvm.sh"

# использование
RUN /bin/bash -c "source /root/.nvm/nvm.sh; nvm install 12"

COPY . /src/
WORKDIR /src/
RUN ls -la

RUN /bin/bash -c "source /root/.nvm/nvm.sh; cd /src/tree; nvm use 12; npm i; npm run-script build;"

CMD /bin/bash -c "mkdir -p /build/; cp -Rv /src/tree/build/* /build/"
