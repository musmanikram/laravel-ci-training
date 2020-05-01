// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add("login", (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add("drag", { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add("dismiss", { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite("visit", (originalFn, url, options) => { ... })

const routePrefix = '__testing__'
const environment = 'testing'

Cypress.Commands.add('clearDatabase', () => {
    cy.exec(`php artisan migrate:refresh --env=${environment}`)
})

Cypress.Commands.add('create', (model, overrides = {}) => {
    return cy.request(`${routePrefix}/create/${model}`, overrides).its('body')
})

Cypress.Commands.add('login', (attributes = {}) => {
    return cy.request(`${routePrefix}/login`, attributes).its('body')
})

Cypress.Commands.add('getTestAttribute', (name, options = {}) => {
    return cy.get(`[data-cy=${name}]`, options)
})

Cypress.Commands.add(
    'uploadFile',
    { prevSubject: 'element' },
    (subject, fileName) => {
        console.log('subject', subject)
        return cy
            .fixture(fileName, 'base64')
            .then(Cypress.Blob.base64StringToBlob)
            .then((blob) => {
                console.log('blob', blob)
                const el = subject[0]
                if (el != null) {
                    const testFile = new File([blob], fileName)
                    const dataTransfer = new DataTransfer()
                    dataTransfer.items.add(testFile)
                    el.files = dataTransfer.files
                }
                return subject
            })
    }
)
