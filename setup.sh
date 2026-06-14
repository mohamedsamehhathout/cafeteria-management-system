#!/bin/bash

# Cafeteria Management System - Complete Setup Script
# This script sets up the entire application

echo "╔════════════════════════════════════════════════════════════╗"
echo "║   CAFETERIA MANAGEMENT SYSTEM - DATABASE SETUP SCRIPT      ║"
echo "╚════════════════════════════════════════════════════════════╝"
echo ""

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Check if MySQL is available
if ! command -v mysql &> /dev/null; then
    echo -e "${RED}❌ ERROR: MySQL/MariaDB is not installed or not in PATH${NC}"
    echo ""
    echo "Please ensure MySQL/MariaDB is installed and added to your PATH:"
    echo "  Windows XAMPP: Add 'C:\\xampp\\mysql\\bin' to your PATH"
    echo "  Windows MySQL: Add 'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin' to your PATH"
    echo "  Windows MariaDB: Add 'C:\\Program Files\\MariaDB 10.x\\bin' to your PATH"
    exit 1
fi

echo -e "${YELLOW}📊 Setting up database...${NC}"
echo ""

# Step 1: Create database and import schema
echo "Step 1: Creating database and importing schema..."
mysql -u root << 'EOF'
DROP DATABASE IF EXISTS cafeteria;
CREATE DATABASE cafeteria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EOF

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Database created${NC}"
else
    echo -e "${RED}❌ Failed to create database${NC}"
    exit 1
fi

# Step 2: Import schema
echo ""
echo "Step 2: Importing database schema..."
mysql -u root cafeteria < database/schema.sql

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Schema imported${NC}"
else
    echo -e "${RED}❌ Failed to import schema${NC}"
    exit 1
fi

# Step 3: Run seeds
echo ""
echo "Step 3: Seeding test data..."
mysql -u root cafeteria < database/seed.sql

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Test data seeded${NC}"
else
    echo -e "${RED}❌ Failed to seed data${NC}"
    exit 1
fi

# Step 4: Verify
echo ""
echo "Step 4: Verifying setup..."
TABLES=$(mysql -u root cafeteria -e "SHOW TABLES;" 2>/dev/null | tail -n +2 | wc -l)
USERS=$(mysql -u root cafeteria -e "SELECT COUNT(*) FROM users;" 2>/dev/null | tail -n +2)

echo -e "${GREEN}✅ Database verification:${NC}"
echo "   📊 Tables created: $TABLES"
echo "   👥 Users in database: $USERS"

echo ""
echo "╔════════════════════════════════════════════════════════════╗"
echo "║              ✅ SETUP COMPLETE!                            ║"
echo "╚════════════════════════════════════════════════════════════╝"
echo ""
echo "📝 Test Credentials:"
echo "   Email: sara.ahmed@company.com"
echo "   Password: password"
echo ""
echo "🔐 Admin Credentials:"
echo "   Email: admin@cafeteria.com"
echo "   Password: password"
echo ""
