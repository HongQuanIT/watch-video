#!/usr/bin/env bash

# REQRUIED:

# prints colored text

print_style () {
    if [ "$2" == "info" ] ; then
        COLOR="96m"
    elif [ "$2" == "success" ] ; then
        COLOR="92m"
    elif [ "$2" == "warning" ] ; then
        COLOR="93m"
    elif [ "$2" == "danger" ] ; then
        COLOR="91m"
    else #default color
        COLOR="0m"
    fi

    STARTCOLOR="\e[$COLOR"
    ENDCOLOR="\e[0m"

    printf "$STARTCOLOR%b$ENDCOLOR" "$1"
}

display_options () {
    printf "Available options :\n";
    print_style "   up [services][only docker]" "success"; printf ": Runs docker compose to up services.\n"
    print_style "   down [services][only docker]" "success"; printf ": Down all services.\n"
    print_style "   exec [service][only docker]" "success"; printf ": Opens bash with user in docker.\n"
    print_style "   install [site]" "success"; printf ": Init new site: overwrite and update .env file, composer install, generate key.\n"
    print_style "   serve [site]" "success"; printf ": Run serve.\n"
    print_style "   tinker [site]" "success"; printf ": Run tinker \n"
    # print_style "   watch [site]" "success"; printf ": Buil FE.\n"
    print_style "   clear [site]" "success"; printf ": Clear and cache config,route,view and run dump-autoload.\n"
}
require_docker_compose () {
    print_style "You must install docker-compose!\n" "warning"
    exit 1
}
##### VARIABLES #####
script_folder="$( cd "$(dirname "$0")" ; pwd -P )"
is_docker_running=false
##### COMMANDS #####

################################ check docker running ( 2> /dev/null ===> not show error when without docker)
if [ "$( docker container inspect -f '{{.State.Status}}' watch-video_php_1 2> /dev/null)" == "running" ]; then
    is_docker_running=true
fi
#################################
cd $script_folder

# up
if [ "$1" == "up" ]; then
    docker-compose -version 2> /dev/null || require_docker_compose
    print_style "Initializing Docker Compose and up services ...\n" "info"
    if [ -z $2 ]; then
        if [[ "$OSTYPE" == "cygwin" || "$OSTYPE" == "msys" || "$OSTYPE" == "win32" ]]; then
            cd $script_folder
            docker-compose up -d
        else
            # Linux or Mac
            docker-compose up -d
        fi
    else
        docker-compose up -d ${@:2}
    fi

# down
elif [ "$1" == "down" ]; then
    if [ "$is_docker_running" == "false" ]; then
        print_style "Only run script when docker php running ...You can run : pim up\n" "warning"
        exit 1
    fi
    print_style "Downing All services and Docker Compose ...\n" "info"
    docker-compose down

# exec
elif [ "$1" == "exec" ]; then
    if [ "$is_docker_running" == "false" ]; then
        print_style "Only run script when docker php running ...You can run : pim up\n" "warning"
        exit 1
    fi
    if [[ "$OSTYPE" == "cygwin" || "$OSTYPE" == "msys" || "$OSTYPE" == "win32" ]]; then

        docker exec -it watch-video_php_1 bash
    else
        # Linux or Mac
        docker exec -it watch-video_php_1 /bin/bash
    fi
# site-init
elif [ "$1" == "install" ]; then
    print_style "Initializing site alpajino in /var/www/html ...\n" "info"
    # init site
    print_style "Init site...\n" "success"
    if [ "$is_docker_running" == "true" ]; then
        print_style "Copy .env.example to .env || composer install ...\n" "info"
        # "install compser and coppy env.example"
        docker exec watch-video_php_1 bash -c "cp -rf .env.example .env && composer install"
        # mirgate
        print_style "Migrate and seeding data ...\n" "info"
        docker exec watch-video_php_1 bash -c "php artisan migrate && php artisan db:seed"
        # update Laravel
        # print_style "Install Passport and Generate OAuth Clients and Personal Access Token ...\n" "info"
        print_style "Clear cache ...\n" "info"
        docker exec watch-video_php_1 bash -c "php artisan route:clear && php artisan config:clear && php artisan cache:clear" #&& php artisan key:generate && php artisan passport:install && php artisan passport:client --personal
        # NPM
        # print_style "Install npm ...\n" "info"
        # docker exec watch-video_php_1 bash -c "npm install"
    else
        print_style "Copy .env.example to .env || composer install ...\n" "info"
        # "cd $script_folder"
        cp -rf .env.example .env && composer install
        # mirgate
        print_style "Migrate and seeding data ...\n" "info"
        php artisan migrate && php artisan db:seed
        # update Laravel
        # print_style "Install Passport and Generate OAuth Clients and Personal Access Token ...\n" "info"
        php artisan route:clear && php artisan config:clear && php artisan cache:clear # && php artisan key:generate && php artisan passport:install && php artisan passport:client --personal
        # NPM
        # print_style "Install npm ...\n" "info"
        # npm install
        print_style "Clear cache ...\n" "info"
    fi
    print_style "Done!\n"
#show option
elif [ "$1" == "--h" ]; then
    display_options
elif [ "$1" == "serve" ]; then
    print_style "Run serve...\n" "info"
    if [ "$is_docker_running" == "true" ]; then
        docker exec watch-video_php_1 bash -c "php artisan serve"
    else
        php artisan serve
    fi
# elif [ "$1" == "watch" ]; then
#     print_style "Run watch (frontend)...\n" "info"
#     if [ "$is_docker_running" == "true" ]; then
#         docker exec watch-video_php_1 bash -c "npm run watch-poll"
#     else
#         npm run watch-poll
#     fi
elif [ "$1" == "tinker" ]; then
    print_style "Running tinker...\n" "info"
    if [ "$is_docker_running" == "true" ]; then
        # print_style "hahaah...\n" "info"
        docker exec -it watch-video_php_1 bash -c "php artisan tinker"
    else
        # print_style "huhu...\n" "info"
        php artisan tinker
    fi
elif [ "$1" == "clear" ]; then
    print_style "Clear cache route,view,config and dump-autoload...\n" "info"
    if [ "$is_docker_running" == "true" ]; then
        print_style "Clear cache ...\n" "info"
        docker exec watch-video_php_1 bash -c "php artisan route:clear && php artisan config:clear && php artisan cache:clear"
        docker exec watch-video_php_1 bash -c 'composer dump-autoload'
        print_style "Success ...\n" "info"
    else
        print_style "Clear cache ...\n" "info"
        php artisan route:clear && php artisan config:clear && php artisan cache:clear
        composer dump-autoload
    fi
else
    print_style "Invalid arguments. Please choose arguments bellow:\n" "danger"
    display_options
    exit 1
fi
