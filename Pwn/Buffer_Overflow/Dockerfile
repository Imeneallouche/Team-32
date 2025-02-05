FROM ubuntu:20.04

WORKDIR /challenge

RUN apt-get update && apt-get install -y     gcc     socat     && rm -rf /var/lib/apt/lists/*

COPY vuln.c /challenge/vuln.c

RUN gcc -fno-stack-protector -z execstack -o vuln vuln.c

RUN echo 0 > /proc/sys/kernel/randomize_va_space

EXPOSE 1337

CMD ["sh", "-c", "socat TCP-LISTEN:1337,reuseaddr,fork EXEC:/challenge/vuln"]
