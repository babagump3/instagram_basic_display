# Instagram Basic Display API を使用し、自分のサイトに自分の Instagram 投稿写真を表示する

## Facebook for Developers でアプリ作成

Facebook for Developers にログインして、アプリを作成する

    https://developers.facebook.com/

「生活者」を選択して「次へ」ボタンをクリック
https://www.evernote.com/l/AAWsDXvQQgVHUpxA4_gT5BD-wPAQp4lbF2I

適宜入力して「アプリを作成」ボタンをクリック
https://www.evernote.com/l/AAV8TjbUQGBOAr4xeKl3q6rP-mY9_WF6xB4

Instagram Basic Display の 「設定」ボタンをクリック
https://www.evernote.com/l/AAVLyeQ5wdtOHoyln5SXLIOMsCKIq08ogMU

「設定」リンクをクリックしてアプリの設定を更新する
https://www.evernote.com/l/AAX67T6yIkBPnaoS_wrDkbcM4tvsrnaHgF0

## ベーシック設定を行う。
「プライバシーポリシーのURL」と「ユーザーデータ削除」にそれぞれURLを入力する。今回の使用に関してはトップページのURLで問題なし。※URLはhttpsでないとNG。
「カテゴリ」「アプリの目的」選択は適宜選択する。
https://www.evernote.com/l/AAUkYhj1kHBEFoxqWwKqwJs3fmRhunyHbWQ

「プラットフォームを追加」ボタンをクリック
https://www.evernote.com/l/AAWdfkvSmeFHJIdWchk_-lh2494vv0-fQNs

「Website」を選択して「次へ」ボタンをクリック
https://www.evernote.com/l/AAWFFvWfT8RH0abjMOfvbD34-KObuRTChgg

「サイトURL」にURLを入力する
最後に「変更を保存」ボタンをクリック
https://www.evernote.com/l/AAUlkw_hZH1M4qncjMt3hZIytmj4uqO9Yog

## Instagram Basic Display アプリの作成
左メニューの「Basic Display」をクリック
「Create New App」ボタンをクリック
https://www.evernote.com/l/AAUHOqxDyj1HLY3I1WpQ443H7IwrF9eUxgw

「表示名」を入力して「アプリを作成」ボタンをクリック
https://www.evernote.com/l/AAUL2FDOpgtM2J1vpuO0lY4dME2tR1k8xZ0

## Instagram Basic Display アプリの設定
「有効なOAuthリダイレクトURI」「コールバックURLの許可の取り消し」「データの削除リクエストURL」にURLを入力。今回の使用に関してはトップページのURLで問題なし。
「変更を保存」ボタンをクリック。
https://www.evernote.com/l/AAWTaefgiDJNcY_95nRFNyQ3j-Nf53wP-x4

## 「Instagramテスター」（←投稿を表示したいInstagramアカウント）の追加。
左メニューの「役割」をクリック
「Instagramテスターを追加」ボタンをクリック
https://www.evernote.com/l/AAVG67D_oaxA4aTCOE6EuJUGGp9ZMetA0iA

入力欄にInstagramアカウントを入力して「送信」ボタンをクリック
https://www.evernote.com/l/AAUjgK2mkpFI1qXlU9jP0s__fIBa-iYbvB4

承認待ちになりました。
https://www.evernote.com/l/AAUGquSE3Q9Ow6jIdxBfGbQcRyn4GQ2dpzM

## Instagramにアクセスし設定画面から招待を承認する
    https://www.instagram.com/accounts/manage_access/

上記URLにアクセス

「テスターへのご招待」をクリックしたのち、「承認する」ボタンをクリック
https://www.evernote.com/l/AAUycYHe8zFOSaIO1gziA8TGPYjJy_-OIUw

## ユーザートークンの発行
「InstagramアプリID」と「コールバックURL」を下記のURLにあてはめ、アクセスする。

    https://api.instagram.com/oauth/authorize?client_id=【InstagramアプリID】&redirect_uri=【コールバックURL】&scope=user_profile,user_media&response_type=code

ログイン認証した後にコールバックURLにリダイレクトされる。

リダイレクトしたURLをコピー ↓こんなURLになるはず

    【コールバックURL】?code=【240字程度のランダムな文字列】

同梱の get_token.php にアクセスして入力項目を埋めて送信する。

↓こちらからも使えます

    https://www.troussier.jp/instagram_basic_display/get_token.php

ユーザートークンを取得できます。

## ユーザートークンの使用
ユーザートークンを同梱の token.txt に入力します

上記 token.txt と、同梱の generate_instagram_json.php をアップします。

generate_instagram_json.php にアクセスすると instagram.json が生成されます。

## 定期的なJSON生成

cron を使用して generate_instagram_json.php を定期実行してください。（generate_instagram_json.php には JSON ファイルが生成されてから4時間以上経過していれば再生成するように記述しています。）

Let's enjoy!!
