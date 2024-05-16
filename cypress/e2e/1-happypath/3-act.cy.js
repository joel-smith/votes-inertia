/// <reference types="cypress" />

describe('Basic Actions', () => {

    before(() => {
        cy.useTestingDatabase();
    })

    beforeEach(() => {
        cy.visit(Cypress.config('baseUrl') + "/login")
        cy.get('input[id="email"]').type('alpha@example.com')
        cy.get('input[id="password"]').type('asdfasdf')
        cy.contains('button', 'Log in').click()
        cy.url().should('include', '/dashboard')
    })

    it('shows no polls initially', () => {
        cy.visit(Cypress.config('baseUrl') + "/dashboard")

        cy.contains('div', "You have created no polls, create one below now!").should('exist')
    })

    it('allows user to create a poll', () => {
        cy.visit(Cypress.config('baseUrl') + "/dashboard")

        cy.get('input[id="title"]').type('Cypress Poll')
        cy.get('input[id="option0"]').type('Cypress Option 0')
        cy.get('input[id="option1"]').type('Cypress Option 1')
        cy.get('button').contains('Add Poll').click()

        cy.url().should('include', '/polls')

        cy.contains('h1', "Cypress Poll").should('exist')
    })

    it ('allows user to vote in a poll they created', () => {
        cy.get('a').contains('Cypress Poll').click()

        cy.url().should('include', '/polls')

        cy.get('span').contains('Cypress Option 0').click()

        cy.get('button').contains('Vote').click()

        cy.url().should('include', '/polls')
        cy.url().should('include', '/results')

        cy.get('h1').contains('Cypress Poll').should('exist')
        cy.get('span').contains('Cypress Option 0').should('exist')
        cy.get('div').contains('1 votes (100.0%)').should('exist')
        cy.get('span').contains('Cypress Option 1').should('exist')
        cy.get('div').contains('0 votes (0.0%)').should('exist')


    })

})