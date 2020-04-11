context("Login", () => {
    it("Valid username password will login user", () => {
        cy.visit("login");
        cy.get("[data-cy=login-email]").type("sikandar@gmail.com");
        cy.get("[data-cy=login-password]").type("12345678");
        cy.get("[data-cy=login-submit-button]")
            .click()
            .get("[data-cy=tweet-input]")
            .should("have.length", 1);
    });

    it("In-valid username password should show error", () => {
        cy.visit("login");
        cy.get("[data-cy=login-email]").type("sikandar@gmail.com");
        cy.get("[data-cy=login-password]").type("wrong-password");
        cy.get("[data-cy=login-submit-button]").click();
        cy.contains(" These credentials do not match our records.");
    });
});
