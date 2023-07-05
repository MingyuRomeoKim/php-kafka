<?php

return [
    /*
     * Kafka 브로커에 보이는 클라이언트의 ID를 설정합니다. 클라이언트 ID는 주로 로그와 메트릭을 생성할 때 사용됩니다.
     */
    'client-id' => '',
    /*
     * bootstrap.servers는 Kafka 브로커에 연결하는 데 필요한 호스트 이름과 포트 번호를 설정합니다.
     */
    'bootstrap-servers' => 'your-kafka:your-port',
    /*
     * group.id는 Kafka 컨슈머 그룹의 ID를 설정합니다. 같은 그룹 ID를 가진 컨슈머들은 같은 메시지를 동시에 처리하지 않습니다.
     */
    'group-id' => 'your-kafka-group-id',
    /*
     * enable.partition.eof는 파티션의 끝(end of file, EOF)에 도달했을 때 표시를 내보내는지 여부를 설정합니다. 이 옵션이 true로 설정되면, 파티션의 끝에 도달하면 컨슈머에게 알려줍니다.
     */
    'enable-partition-eof' => 'true',
    /*
     * auto.offset.reset는 Kafka 컨슈머가 이전에 커밋된 오프셋이 없거나, 현재 오프셋이 더 이상 유효하지 않은 경우 어떻게 처리할지를 설정합니다. 'earliest'로 설정하면 가장 처음의 오프셋에서 시작합니다.
     */
    'auto-offset-reset' => 'earliest',
    /*
     * log_level는 로깅 레벨을 설정합니다. 여기서는 LOG_DEBUG로 설정되어 있으므로, 디버그 레벨의 로그를 출력합니다.
     */
    'log-level' => (string) LOG_DEBUG,
    /*
     * debug는 어떤 종류의 정보를 디버그할지를 설정합니다. 'all'로 설정하면 모든 종류의 정보를 디버그합니다.
     */
    'debug' => 'all',




    /*
     * SASL(간단한 인증 및 보안 계층) 메커니즘을 설정합니다. 일반적으로 "PLAIN", "SCRAM-SHA-256", "SCRAM-SHA-512" 등이 사용됩니다. 빈 문자열은 사용하지 않겠다는 의미입니다.
     */
    'sasl-mechanisms' => '',
    /*
     * 브로커의 호스트 이름 검증에 사용할 알고리즘을 설정합니다. https는 브로커의 호스트 이름을 검증하려면 HTTPS처럼 사용됩니다.
     */
    'ssl-endpoint-identification-algorithm' => '', // https
    /*
     * SASL 인증에 사용할 사용자 이름 및 패스워드를 설정합니다.
     */
    'sasl-username' => '',
    'sasl-password' => '',


    /*
     * 사용할 보안 프로토콜을 설정합니다. 'ssl'은 SSL/TLS를 사용하여 통신을 암호화합니다.
     */
    'security-protocol' => '', // 'ssl'
    /*
     * CA(Certificate Authority) 인증서의 위치를 설정합니다. CA 인증서는 브로커의 서버 인증서를 검증하는 데 사용됩니다.
     */
    'ssl-ca-location' => '', //  __DIR__.'/../../../keys/ca.pem'
    /*
     * 클라이언트의 공개키 인증서의 위치를 설정합니다.
     */
    'ssl-certificate-location' => '', // __DIR__.'/../../../keys/kafka.cert'
    /*
     * 클라이언트의 개인키 인증서의 위치를 설정합니다.
     */
    'ssl-key-location' => '', // __DIR__.'/../../../keys/kafka.key'
];