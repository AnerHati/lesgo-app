<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.10.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.10.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-tutors">
                                <a href="#endpoints-GETapi-tutors">GET api/tutors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chat-contacts">
                                <a href="#endpoints-GETapi-chat-contacts">GET api/chat/contacts</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-chat-messages--contactId-">
                                <a href="#endpoints-GETapi-chat-messages--contactId-">GET api/chat/messages/{contactId}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-chat-messages">
                                <a href="#endpoints-POSTapi-chat-messages">POST api/chat/messages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-reviews-tutor--tutorId-">
                                <a href="#endpoints-GETapi-reviews-tutor--tutorId-">GET api/reviews/tutor/{tutorId}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-attachments">
                                <a href="#endpoints-POSTapi-attachments">POST api/attachments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-attachments--id--download">
                                <a href="#endpoints-GETapi-attachments--id--download">GET api/attachments/{id}/download</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-attachments--id-">
                                <a href="#endpoints-DELETEapi-attachments--id-">DELETE api/attachments/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-notifications">
                                <a href="#endpoints-GETapi-notifications">GET api/notifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-notifications-unread-count">
                                <a href="#endpoints-GETapi-notifications-unread-count">GET api/notifications/unread-count</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-notifications--id--read">
                                <a href="#endpoints-POSTapi-notifications--id--read">POST api/notifications/{id}/read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-notifications-read-all">
                                <a href="#endpoints-POSTapi-notifications-read-all">POST api/notifications/read-all</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-payment--transactionId--snap-token">
                                <a href="#endpoints-POSTapi-payment--transactionId--snap-token">POST api/payment/{transactionId}/snap-token</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-payment--transactionId--refund">
                                <a href="#endpoints-POSTapi-payment--transactionId--refund">Siswa mengajukan permintaan refund untuk transaksi yang sudah dibayar.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-reviews">
                                <a href="#endpoints-POSTapi-reviews">POST api/reviews</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tasks--id--quiz">
                                <a href="#endpoints-GETapi-tasks--id--quiz">Mengambil data soal beserta pilihan gandanya (untuk di-render di Vue)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-tasks--id--submit">
                                <a href="#endpoints-POSTapi-tasks--id--submit">Memproses jawaban yang di-submit siswa dan menghitung skor otomatis</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-classes--id--materials">
                                <a href="#endpoints-GETapi-classes--id--materials">GET api/classes/{id}/materials</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-transactions-student">
                                <a href="#endpoints-GETapi-transactions-student">Endpoint untuk Siswa melihat riwayat tagihan/pembayaran mereka</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-tasks--id--questions">
                                <a href="#endpoints-POSTapi-tasks--id--questions">Menyimpan soal kuis baru beserta pilihan ganda yang dibuat oleh Tutor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-transactions-tutor">
                                <a href="#endpoints-GETapi-transactions-tutor">Endpoint untuk Tutor melihat riwayat pendapatan mereka</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-midtrans-webhook">
                                <a href="#endpoints-POSTapi-midtrans-webhook">POST api/midtrans/webhook</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 14, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-tutors">GET api/tutors</h2>

<p>
</p>



<span id="example-requests-GETapi-tutors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/tutors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tutors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tutors">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6ImhIMDJGRVA2ZkRQT2o1YVg2NU02bVE9PSIsInZhbHVlIjoiR3V2bEtVVnRwUnAxa3czcGpubS84dXBtRi9rZE0rYTRUcGVjamJRejlMSUxOem1QNC9wTEhTbHkzSFhpM3hWdlp2cjJyQ1UvbFF3ekpmQUJ5bnA5Umw4V0xxQUswVzJMNzlENXFOWFhnck9OREVZYm15TndSOFVrN0JHd0Y5Mk0iLCJtYWMiOiJmNDU5Y2I4YmNhNTg4Y2JkNzQzNDYwZjgyZmM1ODg4NDUxNGZiOTdmZTA0YTlkMTg2ZDEwOWUxZTczNWJmMjhkIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:17 GMT; Max-Age=7199; path=/; samesite=lax; laravel-session=eyJpdiI6Ik5ZK0dhbnR0aElneElpeXVVNzV0bnc9PSIsInZhbHVlIjoiQnkzUlJUTGVSNkF1eFhtOERDbGhHSGxqNmJZNlhvN2JiTWVwM28zbldqU2tweGY3ZitsS1pVdlJRVWRkdmtpOVJlUTUrVUl5cUdINVppaHBWRXBPQ2djTmJVYlFoMlA3U3JsZ3JwVlNQblJGWWllMWloTXNabjBtcXRlbXdSZXAiLCJtYWMiOiI2MmQyNDEwNGU5ZDU5MTNiMjExMzIzNGM1ZjdmOTg2YzAwM2Q5MmRkMTcyMTQ1OWIyMDEwMDRiMmMyZTJkZjFiIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:17 GMT; Max-Age=7199; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tutors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tutors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tutors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tutors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tutors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tutors" data-method="GET"
      data-path="api/tutors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tutors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tutors"
                    onclick="tryItOut('GETapi-tutors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tutors"
                    onclick="cancelTryOut('GETapi-tutors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tutors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tutors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tutors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tutors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-chat-contacts">GET api/chat/contacts</h2>

<p>
</p>



<span id="example-requests-GETapi-chat-contacts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/chat/contacts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/chat/contacts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chat-contacts">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6ImV6UFNXTGQ3ZjR6d1p4QWVWTlhabXc9PSIsInZhbHVlIjoiZ0RxQkFBVVVMdm1Yd1Bjc1JWZ2tDOXgrYmxQYTRoVm00aXJBUTNuK3pzZ3BROXVPb0g5MS8xSEticy8ySXBlQnBKaGdzdEZLZUJJU21tS29aU0lZWHlHSndESGRPSDZ3aDl2ZkFzUDgvY21IU093ZkNIMEdZR0d6bFRtUDY4cEUiLCJtYWMiOiJkYTM3YmU3NDExN2ViZDI5NmQ3ODViMDU1ZTdiNzY5M2EzOTcwNTdlOWExNWZhZDExZWFkZDgyNGVlNzZiNzc0IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6ImZxMXZjaytndGdIRWh3Vyt1VGRPTVE9PSIsInZhbHVlIjoiUkVoSXJwQ3NPQWRIamQ5d3BLV0s1LzFHUCtSM3R2UTVhQWFnejFtNk1HSS9WKzlQMnFDR1RlMmlXZk92V1B0bjZ1bW1Weng3YmJlc2oxRG1iQXhUb2JudDE0OXIxNnVZdWc0WVJrbWJzRGJZVVhIczdPNjl1eWZKSWVpdk1TSUQiLCJtYWMiOiIyZjA5ZTM5NjZhZmRiNjAwMTdjNmFjYjE1YTZmZjNhMGMwNzM5OTg4ODQ1NzBhMWM3YTY1OTZhMWI1MjQzYjdlIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chat-contacts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chat-contacts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chat-contacts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chat-contacts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chat-contacts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chat-contacts" data-method="GET"
      data-path="api/chat/contacts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chat-contacts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chat-contacts"
                    onclick="tryItOut('GETapi-chat-contacts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chat-contacts"
                    onclick="cancelTryOut('GETapi-chat-contacts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chat-contacts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chat/contacts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chat-contacts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chat-contacts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-chat-messages--contactId-">GET api/chat/messages/{contactId}</h2>

<p>
</p>



<span id="example-requests-GETapi-chat-messages--contactId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/chat/messages/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/chat/messages/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-chat-messages--contactId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6Ik03MlpkVnp6Tm41QnpNNjVlSDd6WUE9PSIsInZhbHVlIjoiSDRlVEhPVXRGWEdTMWltaE1VZC9lOThmTnBOK0lBa1F3ZXlWZ2E0ZEpJZTZIWWc3dWJBOFZ3c3NBcDYraUptVVJVSHpEQTg2VUhWeWlyZkgrdXdITGR6TytSK2cwSkswbHlTM0xUVlpxNERCbXpVOXVTeHFpemdRRlFDUE1oVzYiLCJtYWMiOiJkMTk4ZjhiNDNkMjNkODFlYWRjNWExZTE1ODQ0ZDFkMDE3ZjA3MTYxNmNhOWUxYzkwYmExY2YyM2UwMDdmMDFkIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6Iml2b0dQVGZKbE5xelZwMlJZdjBkcmc9PSIsInZhbHVlIjoiZlEvK1ZsQnA5Y3JSYzQ5MENOWWR3dlBVQldPSzMvc0xDblN1NzJVRVVzdkltbzlDSGpOd2hmaXh5bGExUVpvaEtKVkxnbWZhMEkweDdkUExBUlhkdURNZ3dqdHQ5YmZYVjcwMXJ6cnRhb3dIUEtUMW5sM0x1bzBlYW9aR1FNOHkiLCJtYWMiOiIxOTBmN2I3YWRiNDE3ZjI3NWE5ZWQ5MzExMGUzNzFhMjA4MmQxNjZlNjVjZWRkZDA1Zjk3NTFhMjM4OTY1MTY5IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-chat-messages--contactId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-chat-messages--contactId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-chat-messages--contactId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-chat-messages--contactId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-chat-messages--contactId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-chat-messages--contactId-" data-method="GET"
      data-path="api/chat/messages/{contactId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-chat-messages--contactId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-chat-messages--contactId-"
                    onclick="tryItOut('GETapi-chat-messages--contactId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-chat-messages--contactId-"
                    onclick="cancelTryOut('GETapi-chat-messages--contactId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-chat-messages--contactId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/chat/messages/{contactId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-chat-messages--contactId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-chat-messages--contactId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>contactId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="contactId"                data-endpoint="GETapi-chat-messages--contactId-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-chat-messages">POST api/chat/messages</h2>

<p>
</p>



<span id="example-requests-POSTapi-chat-messages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/chat/messages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"receiver_id\": \"consequatur\",
    \"message\": \"mqeopfuudtdsufvyvddqa\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/chat/messages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "receiver_id": "consequatur",
    "message": "mqeopfuudtdsufvyvddqa"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-chat-messages">
</span>
<span id="execution-results-POSTapi-chat-messages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-chat-messages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-chat-messages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-chat-messages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-chat-messages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-chat-messages" data-method="POST"
      data-path="api/chat/messages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-chat-messages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-chat-messages"
                    onclick="tryItOut('POSTapi-chat-messages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-chat-messages"
                    onclick="cancelTryOut('POSTapi-chat-messages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-chat-messages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/chat/messages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-chat-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-chat-messages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>receiver_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="receiver_id"                data-endpoint="POSTapi-chat-messages"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the users table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="POSTapi-chat-messages"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 5000 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-reviews-tutor--tutorId-">GET api/reviews/tutor/{tutorId}</h2>

<p>
</p>



<span id="example-requests-GETapi-reviews-tutor--tutorId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/reviews/tutor/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/reviews/tutor/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-reviews-tutor--tutorId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IkpKNnRwalhHNmgzUVdZUG1jaGkzNmc9PSIsInZhbHVlIjoidHBPL200NEhTSm1HYi96bXBOeEM3MFRIVnVsT2ZINmdoODh4a2M0amJNNmhVckdNZGwxck1pMmpJZEp1WkxTa0ZZbWFJeHZoLzBQdWY3bU9CSkJkblVLYkNWUjQ0d0dTWi9zeENlNElNUnVWQ0cwNmwvM1BwaEZXS1k3ME9ycmUiLCJtYWMiOiI3Yjg4NzE4ZDMzODdjM2ZkYjFiZDhmM2I2MzY5M2Y2MWNjMjc3NmQ2ZGFkNGFjYTc5MjRmY2UxOGY4ODZjNmJjIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjJlZHFWSE42OGh4YzVnbnViTWFjeFE9PSIsInZhbHVlIjoiOWVVSUM0amZJN2lqYitEeCtwUkEva1BzMmNDck1DUHV2NmZ0WFZHRWJ5V0o2aDNCbUR0Ym5LSkZ4cUU4SGJPUFYrbHNtVmtXditmSEhoNU5ZQzZ4VlpJTHJHcy9pWmNSK2twbGZJSXpySWlEVHVSbHNnVlYyUWRYaElVTkxmUnkiLCJtYWMiOiI4YjhhNGZiNThjNmVkZTU1ZjQzZTAxZjNmMzA2NTBhMzUzMGUxZmNjNjYzM2FkMmM5YzcwZjRhNWRlZTY1ZTg3IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-reviews-tutor--tutorId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-reviews-tutor--tutorId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-reviews-tutor--tutorId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-reviews-tutor--tutorId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-reviews-tutor--tutorId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-reviews-tutor--tutorId-" data-method="GET"
      data-path="api/reviews/tutor/{tutorId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-reviews-tutor--tutorId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-reviews-tutor--tutorId-"
                    onclick="tryItOut('GETapi-reviews-tutor--tutorId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-reviews-tutor--tutorId-"
                    onclick="cancelTryOut('GETapi-reviews-tutor--tutorId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-reviews-tutor--tutorId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/reviews/tutor/{tutorId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-reviews-tutor--tutorId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-reviews-tutor--tutorId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tutorId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tutorId"                data-endpoint="GETapi-reviews-tutor--tutorId-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-attachments">POST api/attachments</h2>

<p>
</p>



<span id="example-requests-POSTapi-attachments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/attachments" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "attachable_type=consequatur"\
    --form "attachable_id=17"\
    --form "file=@C:\Users\HP\AppData\Local\Temp\php215.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/attachments"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('attachable_type', 'consequatur');
body.append('attachable_id', '17');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-attachments">
</span>
<span id="execution-results-POSTapi-attachments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-attachments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-attachments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-attachments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-attachments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-attachments" data-method="POST"
      data-path="api/attachments"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-attachments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-attachments"
                    onclick="tryItOut('POSTapi-attachments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-attachments"
                    onclick="cancelTryOut('POSTapi-attachments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-attachments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/attachments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-attachments"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-attachments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="POSTapi-attachments"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 10240 kilobytes. Example: <code>C:\Users\HP\AppData\Local\Temp\php215.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attachable_type"                data-endpoint="POSTapi-attachments"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachable_id"                data-endpoint="POSTapi-attachments"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-attachments--id--download">GET api/attachments/{id}/download</h2>

<p>
</p>



<span id="example-requests-GETapi-attachments--id--download">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/attachments/consequatur/download" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/attachments/consequatur/download"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-attachments--id--download">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IkhVbFFmYWk1UGFBd2ZxNlNVRng2RkE9PSIsInZhbHVlIjoieDNZZ241aWpOL0hLUm5XcEZhZU0wblZSWkY3cmhYbE9mTU5IMEZiZkkvb3MwUjJJWERTQlcwSnFvWEQyejJ3d2N6eE5lY2Z1WHFaMUJqbXlYUmQ0VHBORElNRmZDS2dvZ3NxbkllcVBCMjdhVXdReU5GSS8wc1JTK1RMQWpoTG0iLCJtYWMiOiJkMTE4ZDQ1YTk5Yjc5MGFhYWY4NmE2NTcyMzdlZDExY2UxMWJjZWM1YWZlNjdiZTlmNWI1NjdmZTJiN2EyMWU3IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IndydkVnMGRpVkNJQzB5bmF1QW5xdkE9PSIsInZhbHVlIjoiejNlMDBKZlZ4WFJIcXJHZW54SGZ3YWdVNVo4aDFROVl4dy9iUWZqV2VDNW53aHplc0ZBdTNJL2NaZFYremVFS01QcjBjVlBVdFU0WUdrMVNjQ1NFcjBsV29FNy9ncnJjSTRQdm5UNTNVRGJGNDZnVEUzdmdlTllZOFUwbE9GVzYiLCJtYWMiOiJkNWNkYTY4MGRjN2I3OTc1NWI2MGYzMjJlYjU1NDVlY2Q2ZjhmZWQzMjE3ZDcwMTgwNThjOGM4NTQ5MWZmOWY1IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-attachments--id--download" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-attachments--id--download"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-attachments--id--download"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-attachments--id--download" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-attachments--id--download">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-attachments--id--download" data-method="GET"
      data-path="api/attachments/{id}/download"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-attachments--id--download', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-attachments--id--download"
                    onclick="tryItOut('GETapi-attachments--id--download');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-attachments--id--download"
                    onclick="cancelTryOut('GETapi-attachments--id--download');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-attachments--id--download"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/attachments/{id}/download</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-attachments--id--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-attachments--id--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-attachments--id--download"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the attachment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-attachments--id-">DELETE api/attachments/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-attachments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/attachments/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/attachments/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-attachments--id-">
</span>
<span id="execution-results-DELETEapi-attachments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-attachments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-attachments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-attachments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-attachments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-attachments--id-" data-method="DELETE"
      data-path="api/attachments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-attachments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-attachments--id-"
                    onclick="tryItOut('DELETEapi-attachments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-attachments--id-"
                    onclick="cancelTryOut('DELETEapi-attachments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-attachments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/attachments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-attachments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-attachments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-attachments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the attachment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-notifications">GET api/notifications</h2>

<p>
</p>



<span id="example-requests-GETapi-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/notifications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-notifications">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6Ii9YZjduVUFGY0JQVkVFWVljUE9qTkE9PSIsInZhbHVlIjoiRWZNR0ZUL2Q4TStuMERxWVUrUWVaL2R6Y3Q1SmIyNmQ0UFZ6TFM3NHVaaW9ETDRPZDEraGw3ZHRhNUJsand0bnBZVXJkWGdkV21IbkNHVW5oS1d0OHltSU0wVHkwYVoraDNpZE5pdzAvK0txYmtybzQrano1S0x4amhEMEozVlIiLCJtYWMiOiJlY2ExZDg2YmMwMzRhYmE1NTIwYWQ3ZjZjN2MxZDgzYjJhNTg2NjkyM2FlMDcwZDg1MjNjZDk2ZjAyMmMzMTljIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6ImJsclc3ZUc1cGFwV1hNY2YrUmFxcnc9PSIsInZhbHVlIjoicUs5d1c0YXZ4alhabENZOTIyYVBoVmZtNE8ySFNFOEIzWWdMN3VxbTQ0T2tOYUZuQWFBQ1Q1aTV2SXJ0azNpYWUrK0ZtRDhETEZaWU02My96Q1Z0WjM0K1ZwQ0l2OVdpTXRSdWFjZk45QitoekNEZmFHaHFUVWprQjRSOGlLT2EiLCJtYWMiOiJhMDU4NzI4YzEwNThmZjhlODJkY2JmOGE1NWE3OGNmZTc5ZmUxOTY0MzJkYzRmYzI4NmE1OGI4MzlkZGUxMmEyIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-notifications" data-method="GET"
      data-path="api/notifications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-notifications"
                    onclick="tryItOut('GETapi-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-notifications"
                    onclick="cancelTryOut('GETapi-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-notifications-unread-count">GET api/notifications/unread-count</h2>

<p>
</p>



<span id="example-requests-GETapi-notifications-unread-count">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/notifications/unread-count" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications/unread-count"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-notifications-unread-count">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IkdYUXpKcFc2NXFTWS91S3pPSWJlOEE9PSIsInZhbHVlIjoiUkpoME13UHFicHFEdHRXV29WcDIwcUpNQ0FHVDJobzc5WnhPcE9ZbTlTSnFzbGRqNUk5ZXJ1aTVlMXdpN2xCTFBHa3JFVkgyT2VyYXp2VC9wQlhFYnJPYm5BaVZ3RWJtRE1EVlRUVXBqRjBZblN0MFY3UnR5K1gvZm9qeDFFQk4iLCJtYWMiOiJlOTA1ZDVhZjMzMTdiN2QyZmRhNWQwNzk5OTk0ZTIzMDM5NTI2YTkxMDA4NTU3NDlhNGYzOTJhZWNlM2FkYTkwIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IlVVdVErNDBnNldmYTRvYURSbTRpZkE9PSIsInZhbHVlIjoiSVVRVktsT0oxQnpqM1BLY2Z1U3drR3NrczZYUW1LNUhBWFdqcCtCMGFxS2dJTmNwZ3E1a1llZ2g4SE1JNldLTFBMN1BoWTZoeFpEMnY2aXUwYnU1RS9rWnVWZlhMWGNUTXA2a1pWenZzTTArbWg5Y2ZKMFAyRldtWi9aOGE5eHciLCJtYWMiOiI0NGU5ZDRkYmJiN2M3MjQwYjYzODJmYTc0NWQ3NDQ1YzFkOGNjMDQ5MzE5NDczZjU0ZDY1N2E3YmRjMjg2N2U5IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-notifications-unread-count" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-notifications-unread-count"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-notifications-unread-count"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-notifications-unread-count" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-notifications-unread-count">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-notifications-unread-count" data-method="GET"
      data-path="api/notifications/unread-count"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-notifications-unread-count', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-notifications-unread-count"
                    onclick="tryItOut('GETapi-notifications-unread-count');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-notifications-unread-count"
                    onclick="cancelTryOut('GETapi-notifications-unread-count');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-notifications-unread-count"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/notifications/unread-count</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-notifications-unread-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-notifications-unread-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-notifications--id--read">POST api/notifications/{id}/read</h2>

<p>
</p>



<span id="example-requests-POSTapi-notifications--id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/notifications/consequatur/read" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications/consequatur/read"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-notifications--id--read">
</span>
<span id="execution-results-POSTapi-notifications--id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-notifications--id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-notifications--id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-notifications--id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-notifications--id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-notifications--id--read" data-method="POST"
      data-path="api/notifications/{id}/read"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-notifications--id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-notifications--id--read"
                    onclick="tryItOut('POSTapi-notifications--id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-notifications--id--read"
                    onclick="cancelTryOut('POSTapi-notifications--id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-notifications--id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/notifications/{id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-notifications--id--read"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the notification. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-notifications-read-all">POST api/notifications/read-all</h2>

<p>
</p>



<span id="example-requests-POSTapi-notifications-read-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/notifications/read-all" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications/read-all"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-notifications-read-all">
</span>
<span id="execution-results-POSTapi-notifications-read-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-notifications-read-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-notifications-read-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-notifications-read-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-notifications-read-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-notifications-read-all" data-method="POST"
      data-path="api/notifications/read-all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-notifications-read-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-notifications-read-all"
                    onclick="tryItOut('POSTapi-notifications-read-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-notifications-read-all"
                    onclick="cancelTryOut('POSTapi-notifications-read-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-notifications-read-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/notifications/read-all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-payment--transactionId--snap-token">POST api/payment/{transactionId}/snap-token</h2>

<p>
</p>



<span id="example-requests-POSTapi-payment--transactionId--snap-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/payment/consequatur/snap-token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/payment/consequatur/snap-token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-payment--transactionId--snap-token">
</span>
<span id="execution-results-POSTapi-payment--transactionId--snap-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-payment--transactionId--snap-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-payment--transactionId--snap-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-payment--transactionId--snap-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-payment--transactionId--snap-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-payment--transactionId--snap-token" data-method="POST"
      data-path="api/payment/{transactionId}/snap-token"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-payment--transactionId--snap-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-payment--transactionId--snap-token"
                    onclick="tryItOut('POSTapi-payment--transactionId--snap-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-payment--transactionId--snap-token"
                    onclick="cancelTryOut('POSTapi-payment--transactionId--snap-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-payment--transactionId--snap-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/payment/{transactionId}/snap-token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-payment--transactionId--snap-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-payment--transactionId--snap-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>transactionId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transactionId"                data-endpoint="POSTapi-payment--transactionId--snap-token"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-payment--transactionId--refund">Siswa mengajukan permintaan refund untuk transaksi yang sudah dibayar.</h2>

<p>
</p>

<p>Hanya bisa dilakukan jika kelas masih pending atau active dan belum ada jadwal completed.</p>

<span id="example-requests-POSTapi-payment--transactionId--refund">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/payment/consequatur/refund" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/payment/consequatur/refund"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-payment--transactionId--refund">
</span>
<span id="execution-results-POSTapi-payment--transactionId--refund" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-payment--transactionId--refund"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-payment--transactionId--refund"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-payment--transactionId--refund" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-payment--transactionId--refund">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-payment--transactionId--refund" data-method="POST"
      data-path="api/payment/{transactionId}/refund"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-payment--transactionId--refund', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-payment--transactionId--refund"
                    onclick="tryItOut('POSTapi-payment--transactionId--refund');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-payment--transactionId--refund"
                    onclick="cancelTryOut('POSTapi-payment--transactionId--refund');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-payment--transactionId--refund"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/payment/{transactionId}/refund</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-payment--transactionId--refund"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-payment--transactionId--refund"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>transactionId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="transactionId"                data-endpoint="POSTapi-payment--transactionId--refund"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-reviews">POST api/reviews</h2>

<p>
</p>



<span id="example-requests-POSTapi-reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"study_class_id\": \"consequatur\",
    \"rating\": 3,
    \"comment\": \"qeopfuudtdsufvyvddqam\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "study_class_id": "consequatur",
    "rating": 3,
    "comment": "qeopfuudtdsufvyvddqam"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reviews">
</span>
<span id="execution-results-POSTapi-reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reviews" data-method="POST"
      data-path="api/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reviews"
                    onclick="tryItOut('POSTapi-reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reviews"
                    onclick="cancelTryOut('POSTapi-reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>study_class_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="study_class_id"                data-endpoint="POSTapi-reviews"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the study_classes table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-reviews"
               value="3"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="POSTapi-reviews"
               value="qeopfuudtdsufvyvddqam"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>qeopfuudtdsufvyvddqam</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-tasks--id--quiz">Mengambil data soal beserta pilihan gandanya (untuk di-render di Vue)</h2>

<p>
</p>



<span id="example-requests-GETapi-tasks--id--quiz">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/tasks/consequatur/quiz" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tasks/consequatur/quiz"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tasks--id--quiz">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IkZNZURHRkE3THdveUg0U2FMOW94c0E9PSIsInZhbHVlIjoiaFlRYjliTFB2VCtzUHhUMjl0OWk4VDd2NXFSZ1ljMDFxcjZMQVBPTWk4dFNtMkZjVzZDZXlFdEprR0xlTGJTdEM0VkdUdnFFcnJZdGl6L0RjVk1uRU5FOVZhbkQ2TGlvaE52eHk3Z0djdVFyL2RFemt5RDRacFl0R1B6QkowTnUiLCJtYWMiOiI5N2FiM2ZhY2YzZDliMTc1ZWQ2YjM3NjY3ODAxMzUyZThhMWEyNDgwNzViYmQyYjQxNDg5MTMzZThjYmVmNmMyIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IjJ1MkFYMUNKRkVDdVBiY1Q5bVUyYWc9PSIsInZhbHVlIjoiangrRDh0aTNXdFVnRTNzcWV0bVBwMWlOWi9nVGl2cENzQ0JhYkhKSVFacWFqOGxvQ2p6Q2t6YUM0N0NVbVJPbGxOb3g4QUdIMTk0SDNCa2daWmZ6WGp0VXZsNms0OUg4N1BFQ0gwY1ZnNlJlTU5sNVBzSENZdVFnVUcvSGhRVFYiLCJtYWMiOiIyNGI1Y2ZjMmIyZWJjNmRlZTMyNzg1ZDg2NWE2NzNjNjI2MWRkNjYxYzhhMTQ4NWE0NGE0M2NkMmQxMjU4MDRiIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tasks--id--quiz" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tasks--id--quiz"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tasks--id--quiz"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tasks--id--quiz" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tasks--id--quiz">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tasks--id--quiz" data-method="GET"
      data-path="api/tasks/{id}/quiz"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tasks--id--quiz', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tasks--id--quiz"
                    onclick="tryItOut('GETapi-tasks--id--quiz');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tasks--id--quiz"
                    onclick="cancelTryOut('GETapi-tasks--id--quiz');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tasks--id--quiz"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tasks/{id}/quiz</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tasks--id--quiz"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tasks--id--quiz"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-tasks--id--quiz"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-tasks--id--submit">Memproses jawaban yang di-submit siswa dan menghitung skor otomatis</h2>

<p>
</p>



<span id="example-requests-POSTapi-tasks--id--submit">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/tasks/consequatur/submit" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"answers\": []
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tasks/consequatur/submit"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "answers": []
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks--id--submit">
</span>
<span id="execution-results-POSTapi-tasks--id--submit" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks--id--submit"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks--id--submit"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks--id--submit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks--id--submit">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks--id--submit" data-method="POST"
      data-path="api/tasks/{id}/submit"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks--id--submit', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks--id--submit"
                    onclick="tryItOut('POSTapi-tasks--id--submit');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks--id--submit"
                    onclick="cancelTryOut('POSTapi-tasks--id--submit');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks--id--submit"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/{id}/submit</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks--id--submit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks--id--submit"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-tasks--id--submit"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>answers</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="answers"                data-endpoint="POSTapi-tasks--id--submit"
               value=""
               data-component="body">
    <br>
<p>Memastikan frontend mengirim array jawaban (format: [ question_id =&gt; option_id ]).</p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-classes--id--materials">GET api/classes/{id}/materials</h2>

<p>
</p>



<span id="example-requests-GETapi-classes--id--materials">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/classes/consequatur/materials" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/classes/consequatur/materials"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-classes--id--materials">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IllHRXFzS0JKVStXdFBJWmg4d1VzWVE9PSIsInZhbHVlIjoidVcyWVIrL1U1dU9NMjBNWThXRGFnd0VKbXAxMnprMHVLUVFYYUdTVXN4YnB4S3hIU09zSFd4MGZWOStYMzdYL3IrNnJkYXArR0s5OTFQbUF2cEtPK29TY0w0V0hCMUJNMmVseFBaYUx4VkpSZGw5UmF0NTNBOVo1c1pyZWxNUDgiLCJtYWMiOiJlM2I1YTY5MzJjYTdkYTFmZTdiMjA1Mzk1ZWUxYTc5ZThmMGZhYzJmNmY3M2Y5OWZiOTJiNzIyNTg4YjZlODM5IiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IkFibVBCYnp6Mjh1eWQxakdiNmlUdGc9PSIsInZhbHVlIjoiQ0hDVjliYVZSNTgrQ25pTnMyb2pvTWpJSnM2TmJSQ0hpOHBZU0U5Vm9WeC91V0J6cm1xcVFId3VwblJIdStqZUcrd2E2V0o1Wks5UGpNOWV1eVpLbk9aVUhrZ1R4MllZSmx6WVZUUHZteDgyc1A0K0Z3Vk96YlF5QlhNMGNQWkkiLCJtYWMiOiI1YzgyNjM0N2I4MGM0ZTc1MzEyY2UwYjljZWEwNDJhYjM0Y2E0NmY2ZGM1NDUyNzMyM2Q1MDI5OWZjOWNkNjNhIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-classes--id--materials" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-classes--id--materials"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-classes--id--materials"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-classes--id--materials" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-classes--id--materials">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-classes--id--materials" data-method="GET"
      data-path="api/classes/{id}/materials"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-classes--id--materials', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-classes--id--materials"
                    onclick="tryItOut('GETapi-classes--id--materials');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-classes--id--materials"
                    onclick="cancelTryOut('GETapi-classes--id--materials');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-classes--id--materials"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/classes/{id}/materials</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-classes--id--materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-classes--id--materials"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-classes--id--materials"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the class. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-transactions-student">Endpoint untuk Siswa melihat riwayat tagihan/pembayaran mereka</h2>

<p>
</p>



<span id="example-requests-GETapi-transactions-student">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/transactions/student" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/transactions/student"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-transactions-student">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6ImZ4NmNWcllPQWRmSFBRUnBKbjkvalE9PSIsInZhbHVlIjoiT0VuRjVQUDQrUTdwak8wK3Zpbk9ZTzJXd2RXRjJBYlA0QWpMbzk0b2RTYVhWUGl1bGh6aDFZWVlOcVRBeVpYemppTkFNeWZ5TDdlOTlRZUpwVXA4KzdBY2RXRld6WTJqRmFMeEs4U3BFc1IzcmhlclNPUHNzRTYvbFVkS3MrRFMiLCJtYWMiOiJkYjk5YjI4NDM2OWQ0ZTUxOWI3NjkwZTJmMWQ1N2YzMmQ0MzY3Mjc5MzY2ODdlMDJlOWE3OGMwZGM4ZGY3NjZkIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6Imx6anN4dkxnbGdaeHFwazBqWXVySnc9PSIsInZhbHVlIjoiWW1ZYWIyL05IWkdyMnRUbTI1bnZLOGFaY1RjOHo5WmVEWDhjTkczRHdNcDJHRDFFZFJQUkRIa1JuUTJJdlZiMlVXQ0tMRmROMEpaVkw1QXVwdzlvNWtpOEpieCtWb080bHBYUmNiZTUvdlNMYU5WZHgxQVduQUYydmpYMjVGNGUiLCJtYWMiOiIwNmFlMjRmY2QyNGI5ZmExYzY4ZGIzMWVlOWY5ODM1YjQ4YTg1NTRjMjdhMzYwZjJlN2FkNzMwMTlmODVhM2QzIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-transactions-student" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-transactions-student"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-transactions-student"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-transactions-student" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-transactions-student">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-transactions-student" data-method="GET"
      data-path="api/transactions/student"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-transactions-student', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-transactions-student"
                    onclick="tryItOut('GETapi-transactions-student');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-transactions-student"
                    onclick="cancelTryOut('GETapi-transactions-student');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-transactions-student"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/transactions/student</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-transactions-student"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-transactions-student"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-tasks--id--questions">Menyimpan soal kuis baru beserta pilihan ganda yang dibuat oleh Tutor</h2>

<p>
</p>



<span id="example-requests-POSTapi-tasks--id--questions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/tasks/consequatur/questions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"question\": \"consequatur\",
    \"type\": \"multiple_choice\",
    \"options\": [
        {
            \"label\": \"consequatur\",
            \"value\": \"consequatur\",
            \"is_correct\": false
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tasks/consequatur/questions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "consequatur",
    "type": "multiple_choice",
    "options": [
        {
            "label": "consequatur",
            "value": "consequatur",
            "is_correct": false
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-tasks--id--questions">
</span>
<span id="execution-results-POSTapi-tasks--id--questions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-tasks--id--questions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-tasks--id--questions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-tasks--id--questions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-tasks--id--questions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-tasks--id--questions" data-method="POST"
      data-path="api/tasks/{id}/questions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-tasks--id--questions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-tasks--id--questions"
                    onclick="tryItOut('POSTapi-tasks--id--questions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-tasks--id--questions"
                    onclick="cancelTryOut('POSTapi-tasks--id--questions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-tasks--id--questions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/tasks/{id}/questions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-tasks--id--questions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-tasks--id--questions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-tasks--id--questions"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the task. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>question</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="question"                data-endpoint="POSTapi-tasks--id--questions"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-tasks--id--questions"
               value="multiple_choice"
               data-component="body">
    <br>
<p>Example: <code>multiple_choice</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>multiple_choice</code></li> <li><code>essay</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>options</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Pastikan tutor mengirim minimal 2 pilihan jawaban (misal A dan B). Must have at least 2 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="options.0.label"                data-endpoint="POSTapi-tasks--id--questions"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>value</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="options.0.value"                data-endpoint="POSTapi-tasks--id--questions"
               value="consequatur"
               data-component="body">
    <br>
<p>A, B, C, D. Example: <code>consequatur</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>is_correct</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-tasks--id--questions" style="display: none">
            <input type="radio" name="options.0.is_correct"
                   value="true"
                   data-endpoint="POSTapi-tasks--id--questions"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-tasks--id--questions" style="display: none">
            <input type="radio" name="options.0.is_correct"
                   value="false"
                   data-endpoint="POSTapi-tasks--id--questions"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Teks jawaban (misal: "Tokyo"). Example: <code>false</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-transactions-tutor">Endpoint untuk Tutor melihat riwayat pendapatan mereka</h2>

<p>
</p>



<span id="example-requests-GETapi-transactions-tutor">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/transactions/tutor" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/transactions/tutor"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-transactions-tutor">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6Ik8zMXVkSTB0a3lHM0EvOXNnTE9QT3c9PSIsInZhbHVlIjoidTFyVmFvaEtOYkdpUDA1eUEraGZlaUtNRE5CbnVRVTFMODJpOHpuMEZMTXZHdzZ5SWsrNmNoNXplRm9za050NUhZdGxOODJhK21ZYnNoMEFyYlZWVWtsZWE0TDFMMk1lSlFLS2JGV1VTNTdKMnM5NjZLOGUxaUxaSjdybzBIRnMiLCJtYWMiOiJkYmJhYjBkMWFjN2YyZDUxMTEzZjA5NjYxMjUzNGFhMGI5ZTljYWE2ZGJlZmM5ZjQ1ZjBhN2ExZDAxYWUxNzJlIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; samesite=lax; laravel-session=eyJpdiI6IkZCc3pPZkRRaDY2OEhHY3FMVTBDWlE9PSIsInZhbHVlIjoiZjg4dXM2bEVzdHU5bTA5bzV0VmRlVWVPMDZFQ0xWTTcxWEwvb2k2cmlNYkVDWlE0RUtlbU5WR3RYK3FnbUZxalVyMEpiYThLTUI4K3JGazZyS2RTQ0hYN1RiU2c3OXNWL2NnOFhKMmQwMEROZno5RzQ0ZEZjZnlzUkliNWV0UXEiLCJtYWMiOiIyOWMxMzk2YTcwNWZiZmVkNGRhNGJkZmY5M2ZjOTAzNDdmMGUxY2MxZTRmOTI4ODEwNThhZTZiMjFiZjk5OTgxIiwidGFnIjoiIn0%3D; expires=Thu, 14 May 2026 20:20:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-transactions-tutor" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-transactions-tutor"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-transactions-tutor"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-transactions-tutor" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-transactions-tutor">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-transactions-tutor" data-method="GET"
      data-path="api/transactions/tutor"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-transactions-tutor', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-transactions-tutor"
                    onclick="tryItOut('GETapi-transactions-tutor');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-transactions-tutor"
                    onclick="cancelTryOut('GETapi-transactions-tutor');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-transactions-tutor"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/transactions/tutor</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-transactions-tutor"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-transactions-tutor"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-midtrans-webhook">POST api/midtrans/webhook</h2>

<p>
</p>



<span id="example-requests-POSTapi-midtrans-webhook">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/midtrans/webhook" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/midtrans/webhook"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-midtrans-webhook">
</span>
<span id="execution-results-POSTapi-midtrans-webhook" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-midtrans-webhook"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-midtrans-webhook"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-midtrans-webhook" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-midtrans-webhook">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-midtrans-webhook" data-method="POST"
      data-path="api/midtrans/webhook"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-midtrans-webhook', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-midtrans-webhook"
                    onclick="tryItOut('POSTapi-midtrans-webhook');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-midtrans-webhook"
                    onclick="cancelTryOut('POSTapi-midtrans-webhook');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-midtrans-webhook"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/midtrans/webhook</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-midtrans-webhook"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-midtrans-webhook"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
