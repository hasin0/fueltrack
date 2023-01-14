pipeline {
    agent any

    stages {
        stage('Clone Repository') {
            steps {
                git 'https://github.com/hasin0/fueltrack.git'
            }
        }
        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction'
            }
        }
        stage('Run Tests') {
            steps {
                sh 'phpunit'
            }
        }
        stage('Deploy to Server') {
            steps {
                sshagent(['my-ssh-key']) {
                    // sh 'rsync -avz --exclude-from=.rsyncignore /path/to/laravel-app/ user@server:/path/to/deployment/'
                    sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack; \

                 composer install --no-interaction --no-dev; \

                 php artisan migrate --force; \
                 php artisan cache:clear; \
                 php artisan config:cache; \
                  '
                }
            }
        }
    }
}



























// freestyle projects pipelines


// pipeline {
//     agent any
//     stages {
//         stage('Build') {
//             steps {
//                 // sh 'composer install --no-scripts'
//                 //  sh 'composer install --no-interaction'
// echo "building"
//                 // sh 'php artisan key:generate'
//                 // sh 'php artisan migrate --force'
//             }
//         }
//         stage('Test') {
//             steps {
//                 // sh 'phpunit'
//                 echo "testing"
//             }
//         }
//         stage('Deploy') {
//             steps {

//                 // echo "deploying "

                //  sh 'scp target/*.war ubuntu@54.158.64.65:/var/www/html/fueltrack'
                // sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack; \

                //  sh composer install --no-interaction; \

                //  php artisan migrate --force; \
                //  php artisan cache:clear; \
                //  php artisan config:cache; \
                //   '

//                 //    script {
//                 //     def changes = changedFiles(includePaths: ['/var/www/html/fueltrack'], ignoreDeletes: true)
//                 //     changes.each {
//                 //         // sh "scp ${it.path} user@host:/path/to/deploy"
//                 //           echo "deploying "
//                 //     }
//                 //  }
//             }
//         }
//     }
// }


































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

