pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
//                git 'https://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@github.com/hasin0/fueltrack.git'
            //  sh  'sudo mv composer.phar /usr/local/bin/composer'

            //     sh 'composer install --no-interaction'
              sh 'chmod +x scripts/jenkins-build.sh'
         sh './scripts/jenkins-build.sh'
                // sh 'cp .env.example .env'
                // sh 'php artisan key:generate'
                echo "====++++building++++===="
            }
        }
        stage('Test') {
            steps {
                // sh './vendor/bin/phpunit'
                                echo "====++++Testing++++===="

            }
        }
    }

  }

