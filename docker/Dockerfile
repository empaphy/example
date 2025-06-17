# syntax=docker/dockerfile:1.4

FROM ubuntu:24.04

ARG DEBIAN_FRONTEND="noninteractive"
ARG TARGETARCH

# Install `ca-certificates` for custom sources, and shared dependencies.
# language=bash
COPY <<-"EOT" /usr/local/share/docker/RUN.sh
    set -o errexit -o xtrace

    function main() {
      rm /etc/apt/apt.conf.d/docker-clean

      apt-get --yes --quiet update
      apt-get --yes --quiet install --no-install-recommends ca-certificates git unzip
    }

    main "$@"

    rm /usr/local/share/docker/RUN.sh
EOT
RUN --mount=type=cache,sharing=locked,target=/var/cache/apt,id=apt-cache-${TARGETARCH} \
    --mount=type=cache,sharing=locked,target=/var/lib/apt,id=apt-lib-${TARGETARCH} \
    --mount=type=tmpfs,target=/tmp bash /usr/local/share/docker/RUN.sh

COPY etc/apt/sources.list.d/* /etc/apt/sources.list.d/

# Install the appropriate PHP packages.
# language=bash
COPY <<-"EOT" /usr/local/share/docker/RUN.sh
    set -o errexit -o xtrace

    function main() {
      local php_packages=()
      local php_versions=('8.1' '8.2' '8.3' '8.4')
      local php_version

      for php_version in ${php_versions[@]}; do
          php_packages+=(
            php${php_version}-bcmath
            php${php_version}-cli
            php${php_version}-curl
            php${php_version}-mbstring
            php${php_version}-xdebug
            php${php_version}-xml
            php${php_version}-zip
          )
      done

      apt-get --yes --quiet update
      apt-get --yes --quiet install --no-install-recommends ${php_packages[@]}
    }

    main "$@"

    rm /usr/local/share/docker/RUN.sh
EOT
RUN --mount=type=cache,sharing=private,target=/var/cache/apt,id=apt-cache-${TARGETARCH} \
    --mount=type=cache,sharing=private,target=/var/lib/apt,id=apt-lib-${TARGETARCH} \
    --mount=type=tmpfs,target=/tmp bash /usr/local/share/docker/RUN.sh

ARG USER_NAME=ubuntu
ARG GROUP_NAME=ubuntu

COPY --from=composer /usr/bin/composer                    /usr/local/bin/
COPY --from=php      /usr/local/bin/docker-php-entrypoint /usr/local/bin/

USER "$USER_NAME"
WORKDIR /usr/src/app
ENTRYPOINT ["docker-php-entrypoint"]
CMD ["php", "-a"]
