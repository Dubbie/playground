<h1 style="text-align: center;">Playground Laravel Project</h1>
<div style="display: flex; justify-content: center;">
<img src="https://github.com/Dubbie/playground/actions/workflows/main.yml/badge.svg" />
</div>

## What's this?

A simple [Laravel](https://laravel.com/) project configured to be deployed as a serverless application on AWS Lambda using [bref.sh](https://bref.sh/).
The goal of this project is to fully understand how a serverless configuration changes the fundamentals of a Laravel project. (It does, trust me).

The documentation for setting up the local development enviroment for the project is based our [Devilbox](https://devilbox.readthedocs.io/en/latest/) as this repository is more of a reminder for me, how to achieve the move to a serverless setup.

## Development

### Devilbox

To have an easier time with the ever growing list of projects, I am using [Devilbox](https://devilbox.readthedocs.io/en/latest/) to manage my developing enviroment.
If you want to use this project with Sail make sure to configure the `vite.config.js` file to suit your enviroment.

To set up Devilbox, follow their [documentation](https://devilbox.readthedocs.io/en/latest/). (it's pretty good)
Just a heads up, I have renamed my suffix to be `.loc` intsead of `.dvl.to`, if you don't want that, make sure to edit the `vite.config.js` file.

### Bref

#### Getting started

Make sure to follow the [Getting started](https://bref.sh/docs/laravel/getting-started) section of their documentation for Laravel. Don't forget the [setup](https://bref.sh/docs/setup) before it.
This will explain how to run artisan commands as well. (Useful for migrations and such)

```
# Example to migrate the live version
serverless bref:cli --args="migrate --force"
```

This can be automated using CI/CD as well.

#### AWS Configuration

-   Create the required parameters in the [SSM Paramter Store](https://docs.aws.amazon.com/systems-manager/latest/userguide/systems-manager-parameter-store.html).
    You can find the required parameters in the `serverless.yml` file.
-   For the RDS to work, make sure to update the VPC's server rules to allow inbound MySQL / Aurora requests. (Note: You can find the rules inside the VPC settings under the RDS, not on the RDS Istance itself.)

## Deployment

You can find and example GitHub Action to deploy the project inside the `.github/workflows/main.yml` file.
