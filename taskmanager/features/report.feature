# language: en
Feature: Generate a report
  In order to export tasks with details
  As a user or system
  I want to generate various of reports

  Background:
    Given the following tasks exist:
      | Name                       | Status      | Assign | Create date         | Update date         |
      | Add switch language button | TODO        |        | 2018-01-01 00:00:00 | 2018-01-01 00:00:00 |
      | Create footer with year    | TODO        |        | 2018-01-01 00:00:00 | 2018-01-01 00:00:00 |
      | Base HTML template         | DONE        | Sarah  | 2018-01-01 00:00:00 | 2018-01-02 00:00:00 |
      | Twig template              | IN PROGRESS | Sarah  | 2018-01-01 00:00:00 | 2018-01-02 00:00:00 |
      | Setup repository           | CLOSED      | Carl   | 2018-01-01 00:00:00 | 2018-01-02 00:00:00 |
      | Retrospection              | TODO        |        | 2018-01-01 00:00:00 | 2018-01-01 00:00:00 |

  Scenario: Generate report for unfinished tasks
    When I generate a report with the following criteria:
      | Key    | Value            |
      | status | todo,in progress |
    Then report should contain tasks:
      | Name                       |
      | Add switch language button |
      | Create footer with year    |
      | Twig template              |
      | Retrospection              |

  Scenario: Generate report for tasks finished today
    When I generate a report with the following criteria:
      | Key            | Value               |
      | status         | done,closed         |
      | updated after  | 2018-01-02 00:00:00 |
      | updated before | 2018-01-02 23:59:59 |
    Then report should contain tasks:
      | Name               |
      | Base HTML template |
      | Setup repository   |


  Scenario: Generate report for Sarah tasks
    When I generate a report with the following criteria:
      | Key    | Value |
      | assign | Sarah |
    Then report should contain tasks:
      | Name               |
      | Base HTML template |
      | Twig template      |
