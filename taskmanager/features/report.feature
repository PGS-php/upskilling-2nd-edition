# language: en
Feature: Generate a report
  In order to export tasks with details
  As a user or system
  I want to generate various of reports

  Scenario: Generate report for TODO tasks
    Given There is no reports
    And there are "2" tasks with "TODO" status
    When I generate report with criteria "unfinished"
    Then there should be "1" report


#  Scenario: Generate report for open tasks
#Given a user named Bob
#When he define “open tasks” criteria and generate report
#Then PDF raport will be generated

#Scenario: Generate report not delivered
#Given a user named Bob
#When he define “open tasks” criteria and generate report
#And generation failed because
#Then email will be sent to user
#And log message with report id and date will be created
#
#Scenario: Generate weekly report for open tasks
#Given for
#When it’s Friday 9:00
#Then PDF report will be generated and saved