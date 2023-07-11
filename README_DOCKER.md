# 테스트용 도커 컴포즈 사용방법

해당 패키지를 테스트하기위한 카프카 도커 컨테이너 사용방법입니다.<br/>
개발하면서 테스트 진행하며 필요한건 기입해둘예정인데 알아서들 하세용.

## 테스트 토픽 생성 방법
1. 해당 디렉토리의 docker-compose.yml 파일을 실행한다
```shell
$ docker-compose up -d
```
2. 카프카 컨테이너 이름을 확인하고 해당 컨테이너로 진입한다
```shell
$ docker ps -a

CONTAINER ID   IMAGE                              COMMAND                  CREATED          STATUS          PORTS                          NAMES
544755fe4e0e   confluentinc/cp-kafka:latest       "/etc/confluent/dock…"   8 minutes ago    Up 8 minutes    0.0.0.0:9092->9092/tcp         php-kafka-kafka-1
0025b58ba338   confluentinc/cp-zookeeper:latest   "/etc/confluent/dock…"   55 minutes ago   Up 55 minutes   2181/tcp, 2888/tcp, 3888/tcp   php-kafka-zookeeper-1

$ docker exec -it php-kafka-kafka-1 /bin/bash
```
3. 'test-topic' 이름의 토픽을 생성해준다.
```shell
$ /usr/bin/kafka-topics --create --bootstrap-server localhost:9092 --replication-factor 1 --partitions 1 --topic test-topic
```

## 프로듀서 테스트 후 컨슈밍 확인해보기
```shell
$ kafka-console-consumer --bootstrap-server localhost:9092 --topic test-topic --from-beginning
```