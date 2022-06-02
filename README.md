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
リダイレクトしたURLをコピー
↓こんなURLになるはず
【コールバックURL】?code=【240字程度のランダムな文字列】




https://api.instagram.com/oauth/authorize?client_id=401665644802113&redirect_uri=https://www.troussier.jp/&scope=user_profile,user_media&response_type=code

https://troussier.jp/?code=AQDnxRkwvJxAfEKNTgJdQ8V2c0Ej3mPKm5Iw09yrNWRyXd6xVtvtGMqNxNEcZCAh7qx1WToTuMrUUPo9Ww3wkJvkwGnRqcHTfnFr6BhY3xfAnKpiwNi9PI0nCFNKEMUE98rx6l0_J8auRxfxHHQILs4HlOv6Yxk1q6ANAtoTtGmd7XRoOrymbwtySgl5oHtdOh5z9n2EjHAv0BxdNa6-oFpIDQ2cup_IMT7Y7-fbPWn4GQ#_



https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret=dc758d82e51e26cb64b2ee37e19363ee&access_token=AQBGuhFx00l8RZXlj44yGrHh7a_ZytLTyvEOGO8Ih7zuuH23ucaNZqlHED4wSkneSHd-1VOMOhWDBSyqks14jAVj7sDC8aLbvRy_ubowDjGQgetrep3GhxflGHpMypESHYr8I0kDl_5nWr_2eMli95ZlOnDzQqr1EmFrQmUM3HegN_hnocNuRv1I-Ov7JC6mRPgUSA83tqN0OFpw0t7WfH9FFp-EIh_vadcjTjNP7sy7mw







