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
     * Kafka 브로커에 연결하는 데 필요한 호스트 이름과 포트 번호를 설정합니다.
     */
    'metadata-broker-list' => 'kafka:9096',
    /*
     * Kafka 프로듀서가 메시지를 압축하는 데 사용할 코덱을 설정합니다. 'none', 'gzip', 'lz4', 'snappy', 'zstd' 등을 설정할 수 있습니다.
     */
    'compression-codec' => 'snappy',
    /*
     * 메시지 전송에 대한 타임아웃을 설정합니다. 설정된 시간(밀리초 단위) 동안 메시지 전송이 완료되지 않으면 프로듀서는 재시도합니다.
     */
    'message-timeout-ms' => '5000', // 5초
    /*
     * 프로듀서의 아이덤포턴스를 설정합니다. 이 옵션은 "정확히 한 번의" 메시지 전송을 보장합니다. 이는 중복 메시지를 방지하고, 메시지의 순서를 유지합니다.
     */
    'enable-idempotence' => 'true',


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