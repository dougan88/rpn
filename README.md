# rpn


I was using ddev for development. You can do it the same way or just use one of the preconfigured docker php images like this one: https://phpdocker.io/


_**My installation.**_ 

1. Install ddev (`https://ddev.readthedocs.io/en/stable/#installation`)
2. Configure php project like (`https://ddev.readthedocs.io/en/stable/users/cli-usage/#php-project-quickstart`)
3. `cd project_folder/`
4. `ddev composer install`
5. `ddev ssh`
6. Run project like this: `php7.4 index.php`
7. Run tests: `./vendor/bin/phpunit --configuration=phpunit.xml tests/ `


_**Notes about the architecture.**_

The architecture of this app is pretty simple and I hope is self explanatory. It uses factory pattern to construct operations and command pattern to decouple invocation, processing and executing constructed commands. CliInterface was used to process cli input/output and it's pretty easy to switch to a different type of an interface. 

SplQueue and SplStack was used to store operations and operands accordingly as they look the most convenient ones in this context.

Testing. I have decided to not test operations and their factory because they seem to be pretty obvious at the moment. Although this can change in the future. Also I haven't mocked operations and while testing OperationProcessor (which is the main class) as they could be considered as a part of the "unit" in this case. Also tests readability could have suffer in case of the full mocking, imho.

**_ps:_** I'm not really sure if this is php position, because in company description it says python as the first language. In case if python skills are necessary I will gladly rewrite this task in it. Just please let me know.