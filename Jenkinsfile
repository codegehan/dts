pipeline {
    agent any
    environment {
        MY_ROOT_CREDENTIALS = credentials('myrootcredentials')  // ID of your credentials
    }
    stages {
        // stage('Prepare Directory') {
        //     steps {
        //         script {
        //             // Define the directory and backup path
        //             def targetDir = '/usr/share/nginx/html/dts'
        //             def backupDir = '/usr/share/nginx/html/dts_backup'
                    
        //             // Create a backup of the existing content
        //             sh """
        //             sudo mkdir -p ${backupDir}
        //             sudo cp -r ${targetDir}/* ${backupDir}/
        //             """
        //         }
        //     }
        // }      
        stage('Get Source Code') {
            steps {
                script {
                    // Navigate to the target directory and pull the latest code
                    def targetDir = '/usr/share/nginx/html/dts'                 
                    // Check out the code from your GitHub repository
                    dir(targetDir) {
                        sh '''
                        git init || true
                        git remote remove origin || true
                        git remote add origin https://github.com/codegehan/dts.git
                        git fetch origin main
                        git reset --hard origin/main
                        '''
                    }
                }
            }
        }
   
        stage('Restart Server') {
            steps {
                sh '''
                echo $MY_ROOT_CREDENTIALS_PSW | sudo -S systemctl restart nginx
                '''
            }
        }
    }
}
