pipeline {
    // agent {
    //     // docker {
    //     //     image 'php:7.4-fpm'
    //     //     args '-v "$PWD":/var/www/html'
    //     // }
    // }
    stages {
        stage('Build') {
            steps {
                sh 'composer install --no-scripts'
                sh 'php artisan key:generate'
                sh 'php artisan migrate --force'
            }
        }
        stage('Test') {
            steps {
                sh 'phpunit'
            }
        }
        // stage('Deploy') {
        //     steps {
        //         sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . myuser@myserver:/var/www/html'
        //     }
        // }
    }
}


































// pipeline {
//    agent any

//     stages {
//         stage('Build') {
//             steps {

//                                 echo 'building'




//                 //  sh 'php --version'
//                 // sh 'composer install'
//                 // sh 'composer --version'
//                 // sh 'cp .env.example .env'
//                 // sh 'php artisan key:generate'
// //                git 'https://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@github.com/hasin0/fueltrack.git'
//             //  sh  'sudo mv composer.phar /usr/local/bin/composer'

//         //     //     sh 'composer install --no-interaction'
//         //       sh 'chmod +x scripts/jenkins-build.sh'
//         //  sh './scripts/jenkins-build.sh'
//         //         // sh 'cp .env.example .env'
//         //         // sh 'php artisan key:generate'
//             }
//         }
//         stage('Test') {
//             steps {
//                 // sh './vendor/bin/phpunit'
//                                 echo 'test'

//             }
//         }
//     }

//   }

