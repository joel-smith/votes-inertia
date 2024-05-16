# Votes

A simple voting app, supporting multiple users and poll creation

## Features
Authentication and Accounts
Notifications


## Improvements

- refactor the routes somewhat, add VoteController

## Talking Points

- deployed to forge (req's AWS knowledge, DNS setup)
- setup to send email (mailhog locally)
- multi-tenant application
- dynamically rendering content
- dynamically rendering interactive forms
- vue components used to separate concerns
- MVC setup
- testing
  - CI on github actions
  - local unit test
  - e2e testing with cypress

### Commands

mailhog
npx cypress open
cypress run --spec "cypress/e2e/1-happypath/*"

