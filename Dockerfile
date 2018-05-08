
FROM laraedit/laraedit
LABEL Name=library_backend Version=0.0.1
ENV Username=homestead
ENV Password=secret
ENV Database=homestead
# RUN apt-get -y update && apt-get install -y fortunes
CMD node ./hello.js
EXPOSE 80
