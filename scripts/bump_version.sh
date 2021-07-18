#!/bin/sh
set -e

cd $(dirname $0)
export ROOT_FOLDER=$(pwd)/..

if [ -z "$1" ]
  then
    echo "No version supplied"
    exit 1
fi

if [ -z "$2" ]
  then
    echo "No message supplied"
    exit 1
fi

version="$1"
message="$2"

version_file="$ROOT_FOLDER/version"
echo ${version} > ${version_file}

git add ${version_file}
git commit -m "Bump version to ${version}"
git push origin $(git rev-parse --abbrev-ref HEAD)
git tag -a ${version} -m "${message}"
git push origin ${version}
