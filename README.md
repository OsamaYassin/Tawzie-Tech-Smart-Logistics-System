# 🚚 Tawzie Tech — Smart Logistics & Distribution Platform

<p align="center">
  <strong>From field operations to data-driven decision making.</strong>
</p>

<p align="center">
  A smart logistics and distribution management platform combining
  <strong>Web</strong>, <strong>Mobile</strong>, <strong>GIS</strong>,
  and <strong>Data Visualization</strong>.
</p>

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-8-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white)
![Flutter](https://img.shields.io/badge/Flutter-02569B?style=for-the-badge\&logo=flutter\&logoColor=white)
![Dart](https://img.shields.io/badge/Dart-0175C2?style=for-the-badge\&logo=dart\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge\&logo=mysql\&logoColor=white)
![GIS](https://img.shields.io/badge/GIS-Geospatial%20Analysis-2E7D32?style=for-the-badge)

</p>

---

# 📸 Project Preview

<p align="center">
  <img src="Tawize.png" alt="Tawzie Tech Project" width="850">
</p>

---

# 📌 Overview

**Tawzie Tech** is an integrated logistics and distribution management system designed to improve the management, monitoring, and analysis of field distribution operations.

The platform connects:

**Distributors → Points of Sale → Products → Orders → Sales → Locations**

into a centralized digital system.

The project was initially developed as a **Graduation Project in 2022** and was subsequently developed toward a practical solution for real-world logistics and distribution operations.

The system combines:

* 🌐 Web-based management
* 📱 Mobile field application
* 📦 Product and inventory management
* 🚚 Distribution operations
* 📍 GPS and location-based validation
* 🗺️ GIS and interactive maps
* 📊 Data visualization
* 📈 Operational and sales reporting

---

# 🎯 Business Problem

Traditional distribution operations can face several challenges:

* Manual field operations
* Limited visibility of distributor activities
* Difficulty monitoring geographical coverage
* Lack of centralized operational data
* Inventory management challenges
* Limited visibility into sales performance
* Difficulty identifying high-demand geographical areas

### Tawzie Tech addresses these challenges by connecting operational data with digital tools.

```text
                  FIELD OPERATIONS
                         │
                         ▼
                ┌─────────────────┐
                │  Mobile App     │
                │    Flutter      │
                └────────┬────────┘
                         │
                         │ API
                         ▼
                ┌─────────────────┐
                │ Laravel Backend │
                └────────┬────────┘
                         │
                         ▼
                ┌─────────────────┐
                │      MySQL      │
                └────────┬────────┘
                         │
              ┌──────────┴──────────┐
              ▼                     ▼
       ┌─────────────┐       ┌─────────────┐
       │ Web         │       │ GIS / Maps  │
       │ Dashboard   │       │ & Location  │
       └──────┬──────┘       └──────┬──────┘
              │                     │
              └──────────┬──────────┘
                         ▼
                Business Information
```

---

# 💡 Key Features

## 📱 1. Mobile Field Application

The Flutter mobile application is designed for distributors and field agents.

### Main capabilities

* User authentication
* Product ordering
* Point-of-sale management
* Adding new distribution points
* Sales transactions
* GPS location capture
* Field operations
* Geographical validation
* Distributor activity management

---

# 🖥️ 2. Web Management Dashboard

The web dashboard provides administrators with centralized control over the logistics system.

### Main functions

* Product management
* Distributor management
* Point-of-sale management
* Order management
* Transaction monitoring
* Inventory visibility
* Performance monitoring
* Geographical visualization
* Sales analysis

---

# 🗺️ 3. GIS & Location Intelligence

Geographical data is an important component of Tawzie Tech.

The platform integrates mapping technologies to visualize distribution activities and geographical information.

### GIS capabilities

* Interactive maps
* Distribution point visualization
* Distributor location tracking
* Sales geographical analysis
* Heat maps
* Cluster maps
* Geographical coverage analysis

### Technologies

* Leaflet.js
* Mapbox
* Google Maps API
* ArcGIS

---

# 📍 4. Geo-fencing

The system includes a **200-meter geographical validation radius** for selected sales operations.

This allows the platform to verify whether a distributor is operating within the expected geographical area.

```text
                    200 m Radius

                ┌───────────────┐
             ╱                     ╲
           ╱                         ╲
          │          📍               │
          │       Point of Sale      │
          │                           │
           ╲                         ╱
             ╲_____________________╱

                       📱
                   Distributor
```

This feature connects:

**Mobile Technology + GPS + Business Rules + Logistics Operations**

---

# 📦 5. Smart Ordering & Inventory

Distributors can request product quantities based on available inventory.

The system provides a connection between:

```text
Products
   ↓
Inventory
   ↓
Distributor Requests
   ↓
Orders
   ↓
Sales
```

This creates a centralized flow for managing product distribution.

---

# 📊 6. Data Visualization & Reporting

The platform provides visual tools for analyzing operational and sales information.

Examples include:

* Interactive charts
* Sales statistics
* Heat maps
* Cluster maps
* Regional performance visualization
* Product performance analysis
* Distribution monitoring

---

# 📸 Screenshots

## 🖥️ Web Dashboard

The administration dashboard provides an overview of products, distributors, transactions, and operational information.

<p align="center">
  <img src="Dashbord.png" alt="Tawzie Tech Web Dashboard" width="950">
</p>

---

## 🗺️ GIS & Mapping

The GIS interface provides geographical visualization of distribution activities and locations.

<p align="center">
  <img src="MapingPhoto.png" alt="Tawzie Tech GIS Mapping" width="950">
</p>

---

## 📱 Application Interface

The repository also contains the Flutter mobile application used for field operations.

<p align="center">
  <img src="Tawize.png" alt="Tawzie Tech Application" width="750">
</p>

---

# 🏗️ System Architecture

```text
                         ┌──────────────────────┐
                         │    Flutter Mobile    │
                         │     Application      │
                         └──────────┬───────────┘
                                    │
                                    │ REST API
                                    ▼
                         ┌──────────────────────┐
                         │    Laravel 8 API     │
                         │    Business Logic    │
                         └──────────┬───────────┘
                                    │
                                    ▼
                         ┌──────────────────────┐
                         │        MySQL         │
                         │   Relational Data    │
                         └──────────┬───────────┘
                                    │
                    ┌───────────────┴────────────────┐
                    │                                │
                    ▼                                ▼
          ┌───────────────────┐            ┌───────────────────┐
          │   Web Dashboard   │            │    GIS / Maps     │
          │ Monitoring &      │            │ GPS & Location    │
          │ Reporting         │            │ Intelligence      │
          └───────────────────┘            └───────────────────┘
```

---

# 🛠️ Technology Stack

## Backend

* PHP
* Laravel 8
* MVC Architecture
* REST API

## Database

* MySQL
* Relational database
* Normalized database structure

## Mobile

* Flutter
* Dart

## Web

* HTML5
* CSS3
* JavaScript
* Bootstrap 4

## GIS & Mapping

* Leaflet.js
* Mapbox.js
* Google Maps API
* ArcGIS

---

# 📊 Data Model

The system manages several interconnected business entities.

```text
              ┌──────────────┐
              │ Distributors │
              └───────┬──────┘
                      │
                      ▼
              ┌──────────────┐
              │ Points of    │
              │    Sale      │
              └───────┬──────┘
                      │
                      ▼
              ┌──────────────┐
              │ Transactions │
              └───────┬──────┘
                      │
              ┌───────┴────────┐
              ▼                ▼
        ┌──────────┐      ┌──────────┐
        │ Products │      │  Orders  │
        └──────────┘      └──────────┘
```

This operational data creates a foundation for further analysis and business intelligence.

---

# 📈 Data Analytics & Business Intelligence

One of the long-term opportunities of Tawzie Tech is to transform operational logistics data into business insights.

The system can support analysis across several dimensions.

## Sales Analytics

Potential KPIs include:

* Total sales
* Sales growth
* Sales by product
* Sales by region
* Sales by distributor
* Sales by point of sale

## Product Analytics

* Best-selling products
* Low-performing products
* Product demand
* Inventory movement
* Replenishment requirements

## Distributor Analytics

* Distributor activity
* Number of transactions
* Geographical coverage
* Sales performance

## Geographic Analytics

* Sales by geographical area
* Customer density
* Distribution coverage
* High-demand areas
* Potential expansion areas

---

# 🔄 Data Analytics Pipeline

The existing operational system can be extended into a complete analytics pipeline:

```text
                 OPERATIONAL DATA
                        │
                        ▼
                     MySQL
                        │
                        ▼
                Data Extraction
                        │
                        ▼
                       SQL
                        │
                        ▼
              Python / Pandas
                        │
                        ▼
             Data Cleaning & EDA
                        │
                        ▼
                    Power BI
                        │
                        ▼
             Business Dashboards
                        │
                        ▼
             Data-Driven Decisions
```

> **Note:** Python and Power BI are proposed extensions of the project and are not presented as technologies currently implemented in the existing application.

---

# 🎓 Academic & Professional Context

Tawzie Tech was initially developed as a **graduation project in 2022**.

The project combines several areas of information technology:

* Software Engineering
* Web Development
* Mobile Development
* Database Management
* Logistics
* Geographic Information Systems
* Data Visualization
* Business Information Systems

The project demonstrates how a software application can be designed around a real business process and later serve as a foundation for data analytics and business intelligence.

---

# 📂 Repository Structure

```text
Tawzie-Tech-Smart-Logistics-System/
│
├── mobile-app-flutter/
│   └── Flutter mobile application
│
├── web-backend-laravel/
│   └── Laravel backend
│
├── Dashbord.png
│   └── Web dashboard screenshot
│
├── MapingPhoto.png
│   └── GIS / mapping screenshot
│
├── Tawize.png
│   └── Project / application image
│
├── Smart-logistics-services-system.pdf
│   └── Graduation project report
│
├── Presintation.pptx
│   └── Project presentation
│
└── README.md
```

---

# 📚 Documentation

Additional documentation is included in the repository:

### 📄 Graduation Project Report

The PDF contains the project's academic documentation, analysis, design, and implementation details.

### 📊 Project Presentation

The PowerPoint presentation summarizes the project, its objectives, architecture, and main functionalities.

---

# 🚀 Future Development

The project can be further developed into a modern data-driven logistics platform.

## Software Engineering

* [ ] Modernize the Laravel backend
* [ ] Improve API documentation
* [ ] Add automated testing
* [ ] Improve authentication and authorization
* [ ] Add Docker support
* [ ] Add CI/CD

## Data Engineering

* [ ] Design an analytical database
* [ ] Build ETL pipelines
* [ ] Create a data warehouse
* [ ] Automate data extraction
* [ ] Implement data quality checks

## Data Analytics

* [ ] Python / Pandas analysis
* [ ] Exploratory Data Analysis
* [ ] Statistical analysis
* [ ] KPI development
* [ ] Product and customer segmentation

## Business Intelligence

* [ ] Build Power BI dashboards
* [ ] Create interactive KPI monitoring
* [ ] Add geographical sales analysis
* [ ] Analyze distributor performance
* [ ] Build inventory dashboards

## Advanced Analytics

* [ ] Demand forecasting
* [ ] Route optimization
* [ ] Sales prediction
* [ ] Anomaly detection
* [ ] Location intelligence

---

# 🎯 Project Vision

The long-term vision is to evolve Tawzie Tech from a logistics management application into a **data-driven decision-support platform**.

```text
        OPERATIONAL DATA
               │
               ▼
          INFORMATION
               │
               ▼
            INSIGHTS
               │
               ▼
           DECISIONS
               │
               ▼
       BUSINESS PERFORMANCE
```

### **Turning logistics data into actionable business insights.**

---

# 👨‍💻 Author

## Osama Yassin

**Software Engineering · Data Analytics · Business Intelligence · Logistics Technology**

[GitHub](https://github.com/OsamaYassin)

---

# ⭐ Project Summary

Tawzie Tech demonstrates the integration of:

**Software Engineering + Mobile Development + GIS + Logistics + Data**

with a clear path toward:

**Data Analytics + Business Intelligence + Decision Support**

---

<p align="center">
  <strong>🚚 Tawzie Tech — Connecting Logistics, Technology & Data</strong>
</p>
