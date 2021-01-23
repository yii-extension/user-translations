#!/bin/bash

# user
find vendor/yii-extension/user/src/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user.pot"

# user-view
find vendor/yii-extension/user-view-bulma/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-view.pot"
find vendor/yii-extension/user-view-bootstrap5/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-view.pot"

# user-mailer
find vendor/yii-extension/user-mailer-service/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-mailer.pot"

# merge
for i in locales/*/user.po; do
	msgmerge --update --silent "$i" locales/user.pot
done
for i in locales/*/user-view.po; do
	msgmerge --update --silent "$i" locales/user-view.pot
done
for i in locales/*/user-mailer.po; do
	msgmerge --update --silent "$i" locales/user-mailer.pot
done
