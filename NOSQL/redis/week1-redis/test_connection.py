#!/usr/bin/env python3
"""
Quick test to verify Redis connection and basic functionality
"""

import redis
import json

def test_redis_connection():
    print("\n" + "="*60)
    print("Testing Redis Connection")
    print("="*60 + "\n")

    try:
        # Connect to Redis
        r = redis.Redis(host='localhost', port=6379, db=0, decode_responses=True)

        # Test connection
        r.ping()
        print("✅ Successfully connected to Redis!")

        # Test write
        r.set('test:key', 'Hello Redis!')
        print("✅ Successfully wrote data to Redis")

        # Test read
        value = r.get('test:key')
        print(f"✅ Successfully read data: {value}")

        # Test JSON
        test_data = {"repo": "test/repo", "watches": 123}
        r.set('test:json', json.dumps(test_data))
        retrieved = json.loads(r.get('test:json'))
        print(f"✅ Successfully stored and retrieved JSON: {retrieved}")

        # Clean up
        r.delete('test:key', 'test:json')
        print("✅ Cleaned up test data")

        print("\n" + "="*60)
        print("🎉 All tests passed! Your setup is working perfectly!")
        print("="*60 + "\n")
        print("Next steps:")
        print("1. Run: python3 redis_crud_enhanced.py")
        print("2. Import data: Choose option 1")
        print("3. Try the analysis features!")
        print()

    except redis.ConnectionError:
        print("❌ Could not connect to Redis")
        print("\nMake sure Redis is running:")
        print("  cd GitHubArchive-Dataset")
        print("  docker-compose up -d")
    except Exception as e:
        print(f"❌ Error: {e}")

if __name__ == "__main__":
    test_redis_connection()
