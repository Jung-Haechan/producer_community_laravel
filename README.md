<h1>서버 호스트를 위한 가이드</h1>

<h3>.env 세팅</h3>
<ul>
    <li>App_Name을 노래랑놀래로 변경해 주세요.</li>
    <li>cmd 창에서 프로젝트에서 사용할 데이터베이스를 만들어 주세요. (테이블은 만들지 마세요.)</li>
    <li>DB, Mail 부분의 blank를 본인의 서버에 맞게 세팅해 주세요.</li>
    <li>App_URL을 본인 서버의 도메인, 또는 ip 주소로 세팅해 주세요.</li>
</ul>

<h3>터미널</h3>
<ul>
    <li>Terminal에서 해당 프로젝트 폴더에 들어가서
        <p style='color:blue'>
            php artisan key:generate<br>
            php artisan config:clear<br>
            php artisan config:cache<br>
            php artisan migrate
        </p>
        를 실행해 주세요.
    </li><br>
    <li>Terminal에서
        <p>
            php artisan serve --host [local ip address]
        </p>
        를 실행해 주세요.<br>
        *만약 테스트용이라면 php artisan serve만 입력해주세요
    </li>
</ul>
