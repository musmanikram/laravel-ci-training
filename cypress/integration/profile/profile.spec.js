context('Profile', () => {
    beforeEach(() => {
        cy.clearDatabase()
    })

    it('Logged in user can see edit profile button on his/her own profile', () => {
        cy.login().then((user) => {
            cy.visit(`profiles/${user.username}`)
            cy.getTestAttribute(`edit-profile-button`).contains(
                'Edit Profile'
            );
        })
    })

    it('Edit profile httuon won;t be visible on other profiles', () => {
        cy.login().then((user) => {
            cy.create('User', { username: 'john' }).then((friend) => {
                cy.visit('profiles/john')
                cy.getTestAttribute(`edit-profile-button`).should('have.length', 0);
                cy.getTestAttribute(`follow-button-${friend.id}`).click();
            })
        })
    })
})
