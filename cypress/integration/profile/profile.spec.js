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

    it('Edit profile button wont be visible on other profiles', () => {
        cy.login().then((user) => {
            cy.create('User', { username: 'john' }).then((friend) => {
                cy.visit('profiles/john')
                cy.getTestAttribute(`edit-profile-button`).should('have.length', 0);
                cy.getTestAttribute(`follow-button-${friend.id}`).click();
            })
        })
    })

    it('User can successfully update his/her own profile', () => {
        cy.login().then((user) => {
            cy.visit(`profiles/${user.username}`);
            cy.getTestAttribute(`edit-profile-button`).click();
            cy.url().should('include', `profiles/${user.username}/edit`);
            cy.getTestAttribute('profile-name').clear().type('new name');
            cy.getTestAttribute('profile-username').clear().type('newusername');
            cy.getTestAttribute('profile-email').clear().type('newemail@example.com');
            cy.getTestAttribute('profile-password').clear().type('1234567890');
            cy.getTestAttribute('profile-password-confirmation').clear().type('1234567890');

            cy.fixture('images/avatar.png').as('avatar');

            cy.getTestAttribute('profile-avatar').uploadFile('images/avatar.png')

            cy.getTestAttribute('profile-save-button').click();
            cy.getTestAttribute('profile-name').contains('new name');
        })
    })
})
