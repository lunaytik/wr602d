describe('Génération de PDF', () => {
    it('test 1 - login', () => {
        cy.visit('localhost/wr602d/login');

        // Entrer le nom d'utilisateur et le mot de passe
        cy.get('#email').type('test@test.com');
        cy.get('#password').type('test1234');

        // Soumettre le formulaire
        cy.get('button[type="submit"]').click();

        // Vérifier que l'utilisateur est connecté
        cy.contains('You are logged in as test@test.com').should('exist');

        cy.visit('localhost/wr602d/pdf');

        cy.get('#pdf_form_title').type('Titre du PDF');
        cy.get('#pdf_form_url').type('https://example.com');
        cy.get('button[type="submit"]').click();

        cy.contains('Successfully convert the url to pdf').should('exist'); // Remplacez par le texte de confirmation approprié
    });
});
