context('Login', () => {
    before(() => {
        cy.clearDatabase();
    });

    /*it('Valid username password will login user', () => {
        cy.visit('login')
        cy.get('[data-cy=login-email]').type('sikandar@gmail.com')
        cy.get('[data-cy=login-password]').type('12345678')
        cy.get('[data-cy=login-submit-button]')
            .click()
            .get('[data-cy=tweet-input]')
            .should('have.length', 1)
    })

    it('In-valid username password should show error', () => {
        cy.visit('login')
        cy.get('[data-cy=login-email]').type('sikandar@gmail.com')
        cy.get('[data-cy=login-password]').type('wrong-password')
        cy.get('[data-cy=login-submit-button]').click()
        cy.contains(' These credentials do not match our records.')
    })*/

    it('Login user', () => {
        cy.create('User')
            .then((user) => {
                cy.visit('login');
                cy.get('[data-cy=login-email]').type(user.email);
                cy.get('[data-cy=login-password]').type('password');
                cy.get('[data-cy=login-submit-button]')
                    .click();
                cy.url().should('include', '/home');
            });
    });

    /*it('Login user dashboard', () => {
        cy.login()
            .visit('home');
    });*/

})
