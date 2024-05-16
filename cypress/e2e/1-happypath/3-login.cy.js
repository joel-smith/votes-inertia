/// <reference types="cypress" />

describe('Login', () => {

    before(() => {
        cy.useTestingDatabase();
        cy.visit(Cypress.config('baseUrl') + "/login")
    })

    it('allows user to login', () => {
        //lets just use an email we know is in our seeder manually
        cy.get('input[id="email"]').type('alpha@example.com')
        cy.get('input[id="password"]').type('asdfasdf')

        // Submit the registration form
        cy.contains('button', 'Log in').click()

        cy.url().should('include', '/dashboard')

        cy.contains('button', "A User").should('exist')
    })

    // it('shows no polls initially', () => {
    //     cy.visit(Cypress.config('baseUrl') + "/dashboard")
    //
    //     cy.contains('div', "You have created no polls, create one below now!").should('exist')
    // })
})