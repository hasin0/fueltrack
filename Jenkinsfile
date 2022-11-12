// pipeline {
//     agent any

//     stages {
//         stage('Build') {
//             steps {
//                 git 'https://github.com/hasin0/fueltrack.git'
//                 sh 'composer install'
//                 sh 'cp .env.example .env'
//                 sh 'php artisan key:generate'
//             }
//         }
//         stage('Test') {
//             steps {
//                 sh './vendor/bin/phpunit'
//             }
//         }
//     }
// }



























pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
            }
        }
        stage('Test') {
            steps {
                echo 'Testinsg..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
