pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                sh 'composer install --ignore-platform-req=ext-gd'
                //    sh 'composer install --ignore-platform-req=ext-gd'

                // sh 'php artisan key:generate'
            }
        }
        stage('Test') {
            steps {
                // sh 'phpunit'
                echo "testing"
            }
        }
        stage('Deploy') {
            steps {



      sh ' ssh jenkins@54-158-64-65 "cd /var/www/html/fueltrack; \
            git pull origin main; \
            composer install --ignore-platform-req=ext-gd; \
            php artisan migrate --force; \
            php artisan cache:clear; \
            php artisan config:cache; \
    "'




                // sh 'ubuntu@ec2-54-158-64-65 "cd /var/www/html/fueltrack; \

                //   git pull origin main; \
                //   composer install --ignore-platform-req=ext-gd; \
                //    php artisan migrate --force; \
                //    php artisan cache:clear; \
                //    php artisan config:cache; \


                // "'


            }
        }
    }
}




// ssh -i "webserveky.pem" ubuntu@ec2-54-158-64-65.compute-1.amazonaws.com




                //   sh 'scp target/*.war ubuntu@54.158.64.65:/var/www/html/fueltrack'
                    // sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack; \
                    //  sh composer install --ignore-platform-req=ext-gd; \
                    //  php artisan migrate --force; \
                    //  php artisan cache:clear; \
                    //  php artisan config:cache; \
                    //   '

                // echo "deploying "
                // sh 'scp target/*.war ubuntu@54.158.64.65:/var/www/html/fueltrack'
                // sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack'
                // sh 'ssh ubuntu@54.158.64.65 "cd /var/www/html/fueltrack && composer install --ignore-platform-req=ext-gd"'
                // sh 'ssh ubuntu@54.158.64.65 "cd /var/www/html/fueltrack && php artisan migrate --force"'
                // sh 'ssh ubuntu@54.158.64.65 "cd /var/www/html/fueltrack && php artisan cache:clear"'
                // sh 'ssh ubuntu@54.158.64.65 "cd /var/www/html/fueltrack && php artisan config:cache"'










// pipeline {
//     agent any

//     stages {
//         stage('Clone Repository') {
//             steps {
//                 git 'https://github.com/hasin0/fueltrack.git'
//             }
//         }
//         stage('Install Dependencies') {
//             steps {
//                 sh 'composer install --no-interaction'
//             }
//         }
//        stage('Run Tests') {
//     steps {
//         script {
//             //sh 'phpunit'
//             echo "testing"
//         }
//     }
// }
// stage('Deploy to Server') {
//             steps {
//                 sshagent(['id_rsa.pub']) {

//                         sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack; \
//                             composer install --no-interaction --no-dev; \
//                             php artisan migrate --force; \
//                             php artisan cache:clear; \
//                             php artisan config:cache;'

//                 }
//             }
//         }
//     }

//  }


















// jenkins key

// ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQCxfHgdN9eVG1HhQzNCoryNYCAX3AnGPGhjyo82LIOZuN9VsLTCZwnxXBWNZSD13UWy1ekOVeW03oStFfCOw7CQmM3QQavINCqyS2d7XcxcDtQ7fmBDVBobKitohe+ksI9u3mEftucVetd9qQGkvSspX/BaUZNgrVjojPZkA7fn/2L/5SmuVxmE3P++ozMpYFj/IN9yIj6sehyrXO9MfEvnkG1oXkfLl4SVf1P0HA+LcLKo8lQPrkcs0hq+e/zC2RAvM8EZ8j9Xz3ghxbb/+Qyjfv5LVWNUpZ58qjoTOl0uSPTKwqLVyTaIGKUyBdPcx7gbtiBZGHX7pw12Ak+sWwsTy4SAmklpT8ivaIygNkPIZxzrU5AI/TxTWQoO7DyTZveRhOlSc9ERMTbgpAEEipAw6ZaZAv6sGt7j06Ofo1kt1Fqe2a+0CUfSW1b5kEKMVTzeiqgAmgCPBtke6esQK41OWrKzgqO3HXkr8hKwSrNh8drgq6FcKrmDpbbI5ATlRss= jenkins@ip-172-31-95-149

//composer install --ignore-platform-req=ext-gd




// freestyle projects pipelines


// pipeline{
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

//                  sh 'scp target/*.war ubuntu@54.158.64.65:/var/www/html/fueltrack'
//                 sh 'rsync -avz -e "ssh -p22" --exclude-from="rsync-exclude.txt" . ubuntu@54.158.64.65:/var/www/html/fueltrack; \

//                  sh composer install --no-interaction; \

//                  php artisan migrate --force; \
//                  php artisan cache:clear; \
//                  php artisan config:cache; \
//                   '

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

