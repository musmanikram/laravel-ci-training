context('Tweet', () => {
    let loggedInUser = null
    beforeEach(() => {
        cy.clearDatabase()
        cy.login().then((user) => {
            loggedInUser = user
            cy.visit('tweets')
        })
    })

    it('Adding new tweet will show tweet on dashboard', () => {
        cy.getTestAttribute('tweet-input').type('Tweet testing')
        cy.getTestAttribute('tweet-submit-button')
            .click()
            .then(() => {
                // check if tweet is visible on screen
                cy.getTestAttribute(`tweet-body-${loggedInUser.id}`)
                    .first()
                    .contains('Tweet testing')

                // check name of the user for first tweet
                cy.getTestAttribute(`tweet-user-name-${loggedInUser.id}`)
                    .first()
                    .contains(loggedInUser.name)

                // we are checking if user image exist. Cypress will give error if element doesn't exist
                cy.getTestAttribute(`tweet-user-img-${loggedInUser.id}`)
            })
    });

    it('Adding new tweet length than 250 characters will give error', () => {
        const tweet = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ' +
            'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ' +
            'when an unknown printer took a galley of type and scrambled it to make a type specimen book. ' +
            'It has survived not only five centuries, but also the leap into electronic typesetting, ' +
            'remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset ' +
            'sheets containing Lorem Ipsum passages, and more recently with desktop publishing software ' +
            'like Aldus PageMaker including versions of Lorem Ipsum';
        console.log(loggedInUser)
        cy.getTestAttribute('tweet-input').type(tweet)
        cy.getTestAttribute('tweet-submit-button')
            .click()
            .then(() => {
                cy.getTestAttribute(`tweet-error`)
                    .contains('The body may not be greater than 255 characters.');
            })
    })

    it('Adding empty tweet will give error', () => {
        //TODO: check html validation
    })

    it('Friend and your tweet must be visible ', () => {
        //TODO: Friend and your tweet must be visible
        /*
        * Steps:
        * 1. Post one tweet for yourself
        * 2. Follow another user e.g John
        * 3. Login to John
        * 4. Post a a tweet for John
        * 5. John should be be able to see your tweet and his own tweet on his profile
        * */
    })

})
