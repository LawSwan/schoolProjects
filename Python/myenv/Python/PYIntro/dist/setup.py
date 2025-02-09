# This is the setup file to compile programs in py2exe
# Resulting .exe file will be in the dist folder

from distutils.core import setup
import py2exe
import random  # enter all of your imports here that you need for the program seperated by commas
import time
 
progname = "Chase.py"

setup(
    options = {'py2exe': {'bundle_files': 1, 'compressed': True}},
    windows = [{'script': progname}],
    zipfile = None,
)
