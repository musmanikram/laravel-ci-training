context('Tweet', () => {
    beforeEach(() => {
        cy.clearDatabase()
    })

    it('Follow and then unfollow same user', () => {
        cy.login().then((user) => {
            cy.create('User', { username: 'john' }).then((friend) => {
                cy.visit('profiles/john')
                cy.getTestAttribute(`follow-button-${friend.id}`).contains(
                    'Follow me'
                )
                cy.getTestAttribute(`follow-button-${friend.id}`).click()
                cy.getTestAttribute(`follow-button-${friend.id}`).contains(
                    'Unfollow me'
                )
                cy.url().should('include', '/profiles/john')
            })
        })
    })

    it('Follow user should be visible in following list and must be clickable', () => {
        cy.login().then((user) => {
            cy.create('User', { username: 'john' }).then((friend) => {
                cy.visit('profiles/john')
                cy.getTestAttribute(`follow-button-${friend.id}`).click()
                cy.visit(`profiles/${user.username}`);
                cy.getTestAttribute(`following-friend`).should('have.length', 1);

                cy.getTestAttribute(`following-list-anchor-${friend.id}`).click();
                cy.url().should('include', '/profiles/john')
            })
        })
    })

    it('Follow button will be invisible on logged in user profile', () => {
        cy.login().then((user) => {
            cy.visit(`profiles/${user.username}`);
            cy.getTestAttribute(`follow-button-${user.id}`).should('not.exist')
        })
    })
})
