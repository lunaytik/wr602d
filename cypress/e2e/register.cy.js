describe('Formulaire de Création de Compte', () => {
    it('test 1 - création de compte valide', () => {
        cy.visit('localhost/wr602d/register');

        cy.get('#registration_form_email').type('email@cypress.com');
        cy.get('#registration_form_firstname').type('first');
        cy.get('#registration_form_lastname').type('last');
        cy.get('#registration_form_plainPassword').type('motdepasse1234');
        cy.get('#registration_form_agreeTerms').check();

        cy.get('button[type="submit"]').click();

        cy.contains('You are logged in as email@cypress.com').should('exist');
    });

    it('test 2 - création de compte invalide', () => {
        cy.visit('localhost/wr602d/register');

        cy.get('#registration_form_email').type('test@test.com');
        cy.get('#registration_form_firstname').type('first');
        cy.get('#registration_form_lastname').type('last');
        cy.get('#registration_form_plainPassword').type('mdp');
        cy.get('#registration_form_agreeTerms').check();

        cy.get('button[type="submit"]').click();

        cy.contains('There is already an account with this email').should('exist');
        cy.contains('Your password should be at least 6 characters').should('exist');
    });
});
