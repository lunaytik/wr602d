describe('Formulaire de Connexion', () => {
    it('test 1 - connexion OK', () => {
        cy.visit('localhost/wr602d/login');

        // Entrer le nom d'utilisateur et le mot de passe
        cy.get('#email').type('test@test.com');
        cy.get('#password').type('test1234');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que l'utilisateur est connecté
        cy.contains('You are logged in as test@test.com').should('exist');
    });

    it('test 2 - connexion KO', () => {
        cy.visit('localhost/wr602d/login');

        // Entrer un nom d'utilisateur et un mot de passe incorrects
        cy.get('#email').type('test@pasmail.com');
        cy.get('#password').type('fauxmdp');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que le message d'erreur est affiché
        cy.contains('Invalid credentials.').should('exist');
    });
});