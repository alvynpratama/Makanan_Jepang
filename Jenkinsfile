pipeline {
    agent any

    environment {
        DOCKER_IMAGE_NAME = 'alvynwira/makanan-jepang:latest'
        CONTAINER_NAME = 'makanan-jepang-container'
    }

    stages {
        stage('Checkout Code') {
            steps {
                echo 'Mengambil kode dari GitHub...'
                cleanWs()
                checkout scm
            }
        }
        
        stage('Build & Test (PHP Syntax Check)') {
            steps {
                echo 'Menjalankan PHP syntax check (lint)...'
                bat 'docker run --rm -v "%WORKSPACE%":/app -w /app php:8.2-cli find . -name "*.php" -exec php -l {} +'
            }
        }
        
        stage('Docker Build') {
            steps {
                echo "Membangun Docker image: ${DOCKER_IMAGE_NAME}..."
                bat "docker build -t ${DOCKER_IMAGE_NAME} ."
            }
        }

        stage('Push to Docker Hub') {
            environment {
                DOCKER_CREDS = credentials('credentials-dockerhub')
            }
            steps {
                echo 'Logging in to Docker Hub...'
                bat 'docker login -u %DOCKER_CREDS_USR% -p %DOCKER_CREDS_PSW%'
                
                echo "Mendorong (push) image: ${DOCKER_IMAGE_NAME}..."
                bat "docker push ${DOCKER_IMAGE_NAME}"
                
                echo 'Logging out...'
                bat 'docker logout'
            }
        }

        stage('Run Docker Container') {
            steps {
                echo "Memaksa Henti & Hapus container lama (jika ada)..."
                bat "docker rm -f ${CONTAINER_NAME} & exit /b 0"
                
                echo "Menjalankan container baru di port 8089..."
                bat "docker run -d --name ${CONTAINER_NAME} -p 8089:80 ${DOCKER_IMAGE_NAME}"
            }
        }
    }
    
    post {
        always {
            echo 'Pipeline selesai.'
        }
    }
}

