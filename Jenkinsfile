pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
//                git 'https://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@github.com/hasin0/fueltrack.git'
                sh 'composer install --no-interaction'
                // sh 'cp .env.example .env'
                // sh 'php artisan key:generate'
            }
        }
        stage('Test') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }
    }

  }
}
