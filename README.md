
# Hi, I'm Maverick! 👋


# Magento 2 Custom Form with GraphQL Integration

Overview : 
This Magento 2 module adds a custom data through form that integrates with Magento's GraphQL API. It allows interaction through GraphQL queries and mutations, enabling easier interaction with frontend JavaScript frameworks or third-party services.


## Authors

- [@maverick](https://github.com/bmanishjyala)


## Usage

#### GraphQL Queries
    Fetch Customer Data

    Query {
        getCustomerData(name: String){
            name
            email
        }
    }

    Add Custom Data

    Mutation {
        saveCustomerData(name: String!, email: String!){
            success_message
            error_message
        }
    }
## Uninstalling

To remove the module, disable it using:
#### bin/magento module:disable Maverick_CustomerForm
## Support

If you encounter any issues or need assistance with the module, feel free to open an issue or contact us.
