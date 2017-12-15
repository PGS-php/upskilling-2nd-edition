# language: en
  Feature: Task management
    In order to efficiently manage tasks
    As an user
    I want to create, follow up and assign tasks in team

    Scenario: Create a simple task
      Given there is no tasks
      When I create a task named "Add switch language button"
      Then there should be "1" tasks with "TODO" status

