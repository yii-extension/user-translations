#!/bin/bash

# user
find vendor/yii-extension/user/src/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user.pot"

# user-view
find vendor/yii-extension/user-view-bulma/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-view.pot"
find vendor/yii-extension/user-view-bootstrap5/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-view.pot"

# user-mailer
find vendor/yii-extension/user-mailer-service/storage/ -name *.php | xargs xgettext --from-code=utf-8 --language=PHP --no-location --omit-header --sort-output --keyword=translate --output="locales/user-mailer.pot"

# merge
for d in locales/*/ ; do
    for i in locales/*.pot; do
        if [ ! -f "$d$(basename "$i" .pot).po" ]; then
            touch "$d$(basename "$i" .pot).po"
        fi

        msgmerge --update --silent "$d$(basename "$i" .pot).po" $i
    done
done
