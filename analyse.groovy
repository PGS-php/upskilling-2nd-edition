def phpQa(attribute) {
    sh 'docker run --rm -v $(pwd):/project -w /project/ jakzal/phpqa ' + attribute
}

def pull() {
    sh 'docker pull jakzal/phpqa'
}

def prepare() {
    phpQa('rm -rf build && mkdir -p build/logs && chmod 777 -R build/')
}

def composerInstall(workingDir = ".") {
    phpQa('composer install --working-dir=' + workingDir + ' --ignore-platform-reqs --no-scripts --no-progress --no-suggest --prefer-dist --no-dev')
}

def phpcs(srcPaths) {
    phpQa('phpcs --report=checkstyle --report-file=build/logs/checkstyle.xml --standard=PSR2 --encoding=UTF-8 --ignore="*.js" ' + srcPaths.join(' ') + ' || exit 0')

    replaceFilePath('build/logs/checkstyle.xml')
    checkstyle pattern: 'build/logs/checkstyle.xml'
}

def phpstan(srcPaths) {
    phpQa('phpstan analyse ' + srcPaths.join(' ') + ' || exit 0')
}

def phpmetrics(srcPaths) {
    phpQa('phpmetrics --excluded-dirs="vendors" --report-html=build/logs/phpmetrics --violations-xml=build/logs/violations.xml --report-xml=build/logs/phpmetrics.xml ' + srcPaths.join(',') +' || exit 0')
    publishHTMLReport('build/logs', 'phpmetrics', 'PHPMetrics')
}

def phpmd(srcPaths) {
    phpQa('phpmd ' + srcPaths.join(',') + ' xml cleancode,codesize,unusedcode --reportfile build/logs/pmd.xml || exit 0')
    replaceFilePath('build/logs/pmd.xml')
    pmd canRunOnFailed: true, pattern: 'build/logs/pmd.xml'
}

def phpmnd(srcPaths) {
    srcPaths.each { path ->
        phpQa('phpmnd ' + path + ' --exclude=tests --progress --non-zero-exit-on-violation --ignore-strings=return,condition,switch_case,default_parameter,operation || exit 0')
    }
}

def phpcpd(srcPaths) {
    phpQa('phpcpd --log-pmd build/logs/pmd-cpd.xml ' + srcPaths.join(' ') + ' || exit 0')
    replaceFilePath('build/logs/pmd-cpd.xml')
    dry canRunOnFailed: true, pattern: 'build/logs/pmd-cpd.xml'
}

def replaceFilePath(filePath) {
    sh "sed -i 's#/project/#${workspace}/#g' ${filePath}"
}

def publishHTMLReport(reportDir, file, reportName) {
    if (fileExists("${reportDir}/${file}")) {
        publishHTML(target: [
                allowMissing         : true,
                alwaysLinkToLastBuild: true,
                keepAll              : true,
                reportDir            : reportDir,
                reportFiles          : file,
                reportName           : reportName
        ])
    }
}

return this
