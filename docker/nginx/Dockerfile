FROM nginx

# Install nginx and tooling we need
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        nano \
        curl \
        unzip
#     && rm -rf /var/lib/apt/lists/*

RUN apt-get install -y nginx-extras

RUN rm -rf /etc/nginx/sites-enabled/*

COPY config/ /etc/nginx/conf.d
